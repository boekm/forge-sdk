<?php

namespace Boekm\Forge;

use Illuminate\Support\Facades\Http;

use Boekm\Forge\Actions\ManagesServers;

use Boekm\Forge\Exceptions\NotFoundException;
use Boekm\Forge\Exceptions\ValidationException;
use Boekm\Forge\Exceptions\FailedActionException;
use Boekm\Forge\Exceptions\TimeoutException;

class Forge
{
    use ManagesServers;

    private $api;

    function __construct()
    {
        $this->api = Http::baseUrl('https://forge.laravel.com/api/v1')->withToken(config('forge.token'));
    }

    private function handleRequestError($response)
    {
        if ($response->status() == 422) {
            throw new ValidationException($response->json());
        }

        if ($response->status() == 404) {
            throw new NotFoundException();
        }

        if ($response->status() == 400) {
            throw new FailedActionException($response->body());
        }

        throw new \Exception((string) $response->body());
    }

    private function get($url)
    {
        $response = $this->api->get($url);

        if (!$response->ok()) {
            $this->handleRequestError($response);
        }

        return $response->json();
    }

    private function submit($type, $url, $body)
    {
        $response = $this->api->$type($url, $body);

        if (!$response->ok()) {
            $this->handleRequestError($response);
        }

        return $response->json();
    }

    private function post($url, $body)
    {
        return $this->submit('post', $url, $body);
    }

    private function put($url, $body)
    {
        return $this->submit('put', $url, $body);
    }

    private function patch($url, $body)
    {
        return $this->submit('patch', $url, $body);
    }

    private function delete($url, $body)
    {
        return $this->submit('delete', $url, $body);
    }

    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  integer $timeout
     * @param  callable $callback
     * @param  integer $sleep
     * @return mixed
     */
    public function retry($timeout, $callback, $sleep = 5)
    {
        $start = time();

        beginning: if ($output = $callback()) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep($sleep);

            goto beginning;
        }

        throw new TimeoutException($output);
    }
}
