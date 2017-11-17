<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Area;
use App\Models\SensorNode;
use App\Models\Zone;
use App\Policies\AccountPolicy;
use App\Policies\AreaPolicy;
use App\Policies\SensorNodePolicy;
use App\Policies\ZonePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'         => 'App\Policies\ModelPolicy',
        Account::class      => AccountPolicy::class,
        Area::class         => AreaPolicy::class,
        Zone::class         => ZonePolicy::class,
        SensorNode::class   => SensorNodePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
