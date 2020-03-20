<?php

namespace Boekm\Forge\Actions;

trait ManagesCertificates
{
    public function certificates($serverId, $siteId)
    {
        return $this->transformCollection(
            $this->get("servers/$serverId/sites/$siteId/certificates")['certificates'],
            ['server_id' => $serverId, 'site_id' => $siteId]
        );
    }

    public function certificate($serverId, $siteId, $id)
    {
        return $this->get("servers/$serverId/sites/$siteId/certificates/$id")['certificate']
            + ['server_id' => $serverId, 'site_id' => $siteId];
    }

    public function createCertificate($serverId, $siteId, $data)
    {
        $certificate = $this->post("servers/$serverId/sites/$siteId/certificates", $data)['certificate'];
        return $certificate + ['server_id' => $serverId, 'site_id' => $siteId];
    }

    public function obtainLetsEncryptCertificate($serverId, $siteId, $data)
    {
        $certificate = $this->post("servers/$serverId/sites/$siteId/certificates/letsencrypt", $data)['certificate'];
        return $certificate + ['server_id' => $serverId, 'site_id' => $siteId];
    }

    public function activateCertificate($serverId, $siteId, $id)
    {
        $this->post("servers/$serverId/sites/$siteId/certificates/$id/activate");
    }

    public function deleteCertificate($serverId, $siteId, $id)
    {
        $this->delete("servers/$serverId/sites/$siteId/certificates/$id");
    }
}
