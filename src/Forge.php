<?php

namespace Boekm\Forge;

use Illuminate\Support\Facades\Http;

use Boekm\Forge\Exceptions\NotFoundException;
use Boekm\Forge\Exceptions\ValidationException;
use Boekm\Forge\Exceptions\FailedActionException;

class Forge
{
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

    private function post($url, $body)
    {
        $response = $this->api->post($url, $body);

        if (!$response->ok()) {
            $this->handleRequestError($response);
        }

        return $response->json();
    }

    public function servers()
    {
        return $this->get('/servers')['servers'];
    }

    public function server($id)
    {
        return $this->get("/servers/{$id}")['server'];
    }

    public function createServer($body)
    {
        $data = $this->post('/servers', $body);
        $server = array_merge($data['server'], [
            'sudo_password' => $data['sudo_password'],
            'database_password' => $data['database_password']
        ]);
        return $server;
    }
}
