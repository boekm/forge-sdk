<?php

namespace Boekm\Forge;

use Illuminate\Support\Facades\Http;

use Boekm\Forge\Actions\ManagesServers;
use Boekm\Forge\Actions\ManagesSites;
use Boekm\Forge\Actions\ManagesDatabases;
use Boekm\Forge\Actions\ManagesDatabaseUsers;
use Boekm\Forge\Actions\ManagesCertificates;
use Boekm\Forge\Actions\ManagesJobs;
use Boekm\Forge\Actions\ManagesWorkers;
use Boekm\Forge\Exceptions\NotFoundException;
use Boekm\Forge\Exceptions\ValidationException;
use Boekm\Forge\Exceptions\FailedActionException;
use Boekm\Forge\Exceptions\TimeoutException;

class Forge
{
    use ManagesServers;
    use ManagesSites;
    use ManagesDatabases;
    use ManagesDatabaseUsers;
    use ManagesCertificates;
    use ManagesWorkers;
    use ManagesJobs;

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

    private function get($url, $raw = false)
    {
        $response = $this->api->get($url);

        if (!$response->ok()) {
            $this->handleRequestError($response);
        }

        if ($raw) {
            return $response;
        }

        return $response->json();
    }

    private function submit($type, $url, $body = [])
    {
        $response = $this->api->$type($url, $body);

        if (!$response->ok()) {
            $this->handleRequestError($response);
        }

        return $response->json();
    }

    private function post($url, $body = [])
    {
        return $this->submit('post', $url, $body);
    }

    private function put($url, $body = [])
    {
        return $this->submit('put', $url, $body);
    }

    private function patch($url, $body = [])
    {
        return $this->submit('patch', $url, $body);
    }

    private function delete($url)
    {
        return $this->submit('delete', $url);
    }

    protected function transformCollection($collection, $extraData = [])
    {
        return array_map(function ($data) use ($extraData) {
            return $data + $extraData;
        }, $collection);
    }
}
