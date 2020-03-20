<?php

namespace Boekm\Forge\Actions;

trait ManagesDatabases
{
    public function databases($serverId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/mysql")['databases'],
            ['server_id' => $serverId]
        );
    }

    public function database($serverId, $id)
    {
        return $this->get("servers/$serverId/mysql/$id")['database'] + ['server_id' => $serverId];
    }

    public function createDatabase($serverId, $data)
    {
        $database = $this->post("servers/$serverId/mysql", $data)['database'];
        return $database + ['server_id' => $serverId];
    }


    public function updateDatabase($serverId, $id, $data)
    {
        $database = $this->put("servers/$serverId/mysql/$id", $data)['database'];
        return $database + ['server_id' => $serverId];
    }

    public function deleteDatabase($serverId, $id)
    {
        $this->delete("servers/$serverId/mysql/$id");
    }
}
