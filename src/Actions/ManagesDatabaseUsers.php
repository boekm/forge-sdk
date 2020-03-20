<?php

namespace Boekm\Forge\Actions;

trait ManagesDatabaseUsers
{
    public function databaseUsers($serverId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/mysql-users")['users'],
            ['server_id' => $serverId]
        );
    }

    public function databaseUser($serverId, $id)
    {
        return $this->get("servers/$serverId/mysql-users/$id")['user'] + ['server_id' => $serverId];
    }

    public function createDatabaseUser($serverId, $data)
    {
        $user = $this->post("servers/$serverId/mysql-users", $data)['user'];
        return $user + ['server_id' => $serverId];
    }


    public function updateDatabaseUser($serverId, $id, $data)
    {
        $user = $this->put("servers/$serverId/mysql-users/$id", $data)['user'];
        return $user + ['server_id' => $serverId];
    }

    public function deleteDatabaseUser($serverId, $id)
    {
        $this->delete("servers/$serverId/mysql-users/$id");
    }
}
