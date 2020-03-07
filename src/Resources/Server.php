<?php

namespace Boekm\Forge\Resources;

class Server extends Resource
{
    /**
     * Update the given server.
     *
     * @param  array $data
     * @return Server
     */
    public function update(array $data)
    {
        return $this->forge->updateServer($this->id, $data);
    }

    /**
     * Delete the given server.
     *
     * @return void
     */
    public function delete()
    {
        return $this->forge->deleteServer($this->id);
    }

    /**
     * Reboot the server.
     *
     * @return void
     */
    public function reboot()
    {
        return $this->forge->rebootServer($this->id);
    }

    /**
     * Revoke forge access to the server.
     *
     * @return void
     */
    public function revokeAccess()
    {
        return $this->forge->revokeAccessToServer($this->id);
    }

    /**
     * Reconnect the server to Forge with a new key.
     *
     * @return string
     */
    public function reconnect()
    {
        return $this->forge->reconnectToServer($this->id);
    }

    /**
     * Reactivate a revoked server.
     *
     * @return void
     */
    public function reactivate()
    {
        return $this->forge->reactivateToServer($this->id);
    }

    /**
     * Reboot MySQL on the server.
     *
     * @return void
     */
    public function rebootMysql()
    {
        return $this->forge->rebootMysql($this->id);
    }

    /**
     * Stop MySQL on the server.
     *
     * @return void
     */
    public function stopMysql()
    {
        return $this->forge->stopMysql($this->id);
    }

    /**
     * Reboot Postgres on the server.
     *
     * @return void
     */
    public function rebootPostgres()
    {
        return $this->forge->rebootPostgres($this->id);
    }

    /**
     * Stop Postgres on the server.
     *
     * @return void
     */
    public function stopPostgres()
    {
        return $this->forge->stopPostgres($this->id);
    }

    /**
     * Reboot Nginx on the server.
     *
     * @return void
     */
    public function rebootNginx()
    {
        return $this->forge->rebootNginx($this->id);
    }

    /**
     * Stop Nginx on the server.
     *
     * @return void
     */
    public function stopNginx()
    {
        return $this->forge->stopNginx($this->id);
    }

    /**
     * Reboot PHP on the server.
     *
     * @return void
     */
    public function rebootPHP()
    {
        return $this->forge->rebootPHP($this->id);
    }

    /**
     * Install Blackfire on the server.
     *
     * @param  array $data
     * @return Server
     */
    public function installBlackfire(array $data)
    {
        return $this->forge->installBlackfire($this->id, $data);
    }

    /**
     * Remove Blackfire from the server.
     *
     * @return Server
     */
    public function removeBlackfire()
    {
        return $this->forge->removeBlackfire($this->id);
    }

    /**
     * Install Papertrail on the server.
     *
     * @param  array $data
     * @return Server
     */
    public function installPapertrail(array $data)
    {
        return $this->forge->installPapertrail($this->id, $data);
    }

    /**
     * Remove Papertrail from the server.
     *
     * @return Server
     */
    public function removePapertrail()
    {
        return $this->forge->removePapertrail($this->id);
    }

    /**
     * Enable OPCache on the server.
     *
     * @return Server
     */
    public function enableOPCache()
    {
        return $this->forge->enableOPCache($this->id);
    }

    /**
     * Disable OPCache on the server.
     *
     * @return Server
     */
    public function disableOPCache()
    {
        return $this->forge->disableOPCache($this->id);
    }

    /**
     * Upgrade to latest PHP version.
     *
     * @return Server
     */
    public function upgradePHP()
    {
        return $this->forge->upgradePHP($this->id);
    }
}
