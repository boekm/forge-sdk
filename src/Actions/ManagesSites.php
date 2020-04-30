<?php

namespace Boekm\Forge\Actions;

trait ManagesSites
{
    public function sites($serverId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/sites")['sites'],
            ['server_id' => $serverId]
        );
    }

    public function site($serverId, $id)
    {
        return $this->get("servers/$serverId/sites/$id")['site'] + ['server_id' => $serverId];
    }

    public function createSite($serverId, $data)
    {
        $site = $this->post("servers/$serverId/sites", $data)['site'];
        return $site + ['server_id' => $serverId];
    }

    public function deleteSite($serverId, $id)
    {
        $this->delete("servers/$serverId/sites/$id");
    }

    public function installGitRepositoryOnSite($serverId, $id, array $data)
    {
        $this->post("servers/$serverId/sites/$id/git", $data);
    }

    public function siteDeploymentScript($serverId, $id)
    {
        return $this->get("servers/$serverId/sites/$id/deployment/script");
    }

    public function updateSiteDeploymentScript($serverId, $id, $content)
    {
        $this->put("servers/$serverId/sites/$id/deployment/script", compact('content'));
    }

    public function siteEnvironmentFile($serverId, $id)
    {
        return $this->get("servers/$serverId/sites/$id/env", true)->body();
    }

    public function updateSiteEnvironmentFile($serverId, $id, $content)
    {
        $this->put("servers/$serverId/sites/$id/env", compact('content'));
    }
}
