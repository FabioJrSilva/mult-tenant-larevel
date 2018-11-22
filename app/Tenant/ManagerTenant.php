<?php

namespace App\Tenant;

use App\Models\Tenant;


class ManagerTenant
{
    public function getTenantIdentify()
    {
        // return $this->getTenant()->id;
        return auth()->user()->tenant_id;
    }

    public function getTenant(): Tenant
    {
        return auth()->user()->tenant;
    }
}
