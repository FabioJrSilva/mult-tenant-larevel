<?php

namespace App\Scopes\Tenant;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();
        // if (auth()->user()->name == "Fabio Jr") {
        //     return $builder;
        // }
        // $builder->where('tenant_id', $tenant);
        return $builder;
    }
}
