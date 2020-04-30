<?php

namespace Boekm\Forge\Actions;

trait ManagesWorkers
{
    public function workers($serverId, $siteId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/sites/$siteId/workers")['workers'],
            ['server_id' => $serverId, 'site_id' => $siteId]
        );
    }

    public function worker($serverId, $siteId, $id)
    {
        return $this->get("servers/$serverId/sites/$siteId/workers/$id")['worker'] + ['server_id' => $serverId, 'site_id' => $siteId];
    }

    public function createWorker($serverId, $siteId, $data)
    {
        $worker = $this->post("servers/$serverId/sites/$siteId/workers", $data)['worker'];
        return $worker + ['server_id' => $serverId, 'site_id' => $siteId];
    }

    public function deleteWorker($serverId, $siteId, $id)
    {
        $this->delete("servers/$serverId/sites/$siteId/workers/$id");
    }

    public function restartWorker($serverId, $siteId, $id)
    {
        $this->post("servers/$serverId/sites/$siteId/workers/$id/restart");
    }
}
