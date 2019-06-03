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
            $menu->add('Dashboard', 'dashboard')
                ->active('/*')
                ->active('engineers/*')
                ->data('icon', 'flaticon-line-graph');
            //
//            $menu->dashboard->add('Dashboard', ['route' => 'dashboard']);


            $menu->add('Incidents', ['route' => 'incidents.index', ])
                ->data('icon', 'flaticon-warning-sign');


            $menu->add('Users',  ['route' => 'users.index', ])
                ->data('icon', 'flaticon-users')
                ->active('/users/*');

            $menu->users->add('All Users', ['route' => 'users.index',]);
            $menu->users->add('Add New User', ['route' => 'users.create',]);

            $menu->add('Manage', [])->active('manage/*')
                ->data('icon', 'flaticon-interface-8');

            $menu->manage->add('Roles', ['route' => 'roles.index',])->data('permission', 'list roles');
            $menu->manage->add('Permissions', ['route' => 'permissions.index',])->data('permission', 'list permissions');
            $menu->manage->add('Departments', ['route' => 'departments.index',])->data('permission', 'list departments');

            $menu->add('System', [])
                ->data('icon', 'flaticon-cogwheel-2');
            $menu->system->add('Types', ['route' => 'types.index']);
            $menu->system->add('Categories', ['route' => 'categories.index']);


        });

        return $next($request);
    }
}