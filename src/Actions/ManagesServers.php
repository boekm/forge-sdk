<?php

namespace Boekm\Forge\Actions;

trait ManagesServers
{
    public function servers()
    {
        return $this->transformCollection(
            $this->get('servers')['servers']
        );
    }

    public function server($id)
    {
        return $this->get("servers/$id")['server'];
    }

    public function createServer($data)
    {
        $response = $this->post('/servers', $data);
        $server = $response['server'];
        if (array_key_exists('sudo_password', $response)) {
            $server['sudo_password'] = $response['sudo_password'];
        }
        if (array_key_exists('database_password', $response)) {
            $server['database_password'] = $response['database_password'];
        }
        if (array_key_exists('provision_command', $response)) {
            $server['provision_command'] = $response['provision_command'];
        }
        return $server;
    }

    /**
     * Update the given server.
     *
     * @param  string $id
     * @param  array $data
     * @return Server
     */
    public function updateServer($id, array $data)
    {
        return $this->put("servers/$id", $data)['server'];
    }

    /**
     * Delete the given server.
     *
     * @param  string $id
     * @return void
     */
    public function deleteServer($id)
    {
        $this->delete("servers/$id");
    }

    /**
     * Revoke forge access to the server.
     *
     * @param  string $id
     * @return void
     */
    public function revokeAccessToServer($id)
    {
        $this->post("servers/$id/revoke");
    }

    /**
     * Reconnect the server to Forge with a new key.
     *
     * @param  string $id
     * @return void
     */
    public function reconnectToServer($id)
    {
        $this->post("servers/$id/reconnect")['public_key'];
    }

    /**
     * Reactivate a revoked server.
     *
     * @param  string $id
     * @return void
     */
    public function reactivateToServer($id)
    {
        $this->post("servers/$id/reactivate");
    }

    /**
     * Reboot the server.
     *
     * @param  string $id
     * @return void
     */
    public function rebootServer($id)
    {
        $this->post("servers/$id/reboot");
    }

    /**
     * Reboot MySQL on the server.
     *
     * @param  string $id
     * @return void
     */
    public function rebootMysql($id)
    {
        $this->post("servers/$id/mysql/reboot");
    }

    /**
     * Stop MySQL on the server.
     *
     * @param  string $id
     * @return void
     */
    public function stopMysql($id)
    {
        $this->post("servers/$id/mysql/stop");
    }

    /**
     * Reboot Postgres on the server.
     *
     * @param  string $id
     * @return void
     */
    public function rebootPostgres($id)
    {
        $this->post("servers/$id/postgres/reboot");
    }

    /**
     * Stop Postgres on the server.
     *
     * @param  string $id
     * @return void
     */
    public function stopPostgres($id)
    {
        $this->post("servers/$id/postgres/stop");
    }

    /**
     * Reboot Nginx on the server.
     *
     * @param  string $id
     * @return void
     */
    public function rebootNginx($id)
    {
        $this->post("servers/$id/nginx/reboot");
    }

    /**
     * Stop Nginx on the server.
     *
     * @param  string $id
     * @return void
     */
    public function stopNginx($id)
    {
        $this->post("servers/$id/nginx/stop");
    }

    /**
     * Reboot PHP on the server.
     *
     * @param  string $id
     * @return void
     */
    public function rebootPHP($id, array $data)
    {
        $this->post("servers/$id/php/reboot", $data);
    }

    /**
     * Install Blackfire on the server.
     *
     * @param  string $id
     * @param  array $data
     * @return void
     */
    public function installBlackfire($id, array $data)
    {
        $this->post("servers/$id/blackfire/install", $data);
    }

    /**
     * Remove Blackfire from the server.
     *
     * @param  string $id
     * @return void
     */
    public function removeBlackfire($id)
    {
        $this->delete("servers/$id/blackfire/remove");
    }

    /**
     * Install Papertrail on the server.
     *
     * @param  string $id
     * @param  array $data
     * @return void
     */
    public function installPapertrail($id, array $data)
    {
        $this->post("servers/$id/papertrail/install", $data);
    }

    /**
     * Remove Papertrail from the server.
     *
     * @param  string $id
     * @param  array $data
     * @return void
     */
    public function removePapertrail($id)
    {
        $this->delete("servers/$id/papertrail/remove");
    }

    /**
     * Enable OPCache on the server.
     *
     * @param  string $id
     * @return void
     */
    public function enableOPCache($id)
    {
        $this->post("servers/$id/php/opcache");
    }

    /**
     * Disable OPCache on the server.
     *
     * @param  string $id
     * @return void
     */
    public function disableOPCache($id)
    {
        $this->delete("servers/$id/php/opcache");
    }

    /**
     * Upgrade to latest PHP version.
     *
     * @param $id
     * @return void
     */
    public function upgradePHP($id)
    {
        $this->post("servers/$id/php/upgrade");
    }
}
