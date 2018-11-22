<?php

namespace App\Http\Middleware\Tenant;

use Closure;
use App\Tenant\ManagerTenant;

class TenantFilesystems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check())
            $this->setfilesystemsRoot();

        return $next($request);
    }

    public function setfilesystemsRoot()
    {
        $tenant = app(ManagerTenant::class)->getTenant();

        config()->set(
            'filesystems.disks.tenant.root',
            config('filesystems.disks.tenant.root') . "/{$tenant->uuid}"
        );

    }
}
