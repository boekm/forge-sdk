<?php

namespace Boekm\Forge\Actions;

trait ManagesJobs
{
    public function jobs($serverId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/jobs")['jobs'],
            ['server_id' => $serverId]
        );
    }

    public function job($serverId, $id)
    {
        return $this->get("servers/$serverId/jobs/$id")['job'] + ['server_id' => $serverId];
    }

    public function createJob($serverId, $data)
    {
        $job = $this->post("servers/$serverId/jobs", $data)['job'];

        return $job + ['server_id' => $serverId];
    }

    public function deleteJob($serverId, $id)
    {
        $this->delete("servers/$serverId/jobs/$id");
    }
}
