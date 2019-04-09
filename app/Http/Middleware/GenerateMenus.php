<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
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
        \Menu::make('MHeaderBottom', function ($menu) {
            $menu->add('Dashboard', 'dashboard')->active('/*')->active('engineers/*');
            $menu->dashboard->add('Dashboard', ['route' => 'dashboard','icon'=>'flaticon-line-graph']);


            $menu->add('Incidents', ['route' => 'incidents.index', ]);

            $menu->add('Users',  ['route' => 'users.index', ]);
            $menu->users->add('View All', ['route' => 'users.index',]);

            $menu->add('Manage', [])->active('manage/*');
            $menu->manage->add('Roles', ['route' => 'roles.index',])->data('permission', 'list roles');;
            $menu->manage->add('Permissions', ['route' => 'permissions.index',])->data('permission', 'list permissions');;
            $menu->manage->add('Users', ['route' => 'users.index',])->data('permission', 'list users');;

            $menu->add('System', []);

        });

        return $next($request);
    }
}