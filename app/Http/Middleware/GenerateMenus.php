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
                ->data('icon', 'la la-dashboard');

            $menu->add('Incidents', ['route' => 'incidents.index', ])
                ->data('icon', 'la 	la-exclamation-triangle');


            $menu->add('Users',  ['route' => 'users.index', ])
                ->data('icon', 'la la-users')
                ->active('/users/*');

            $menu->users->add('All Users', ['route' => 'users.index',]);
            $menu->users->add('Add New User', ['route' => 'users.create',]);
            $menu->users->add('Working Groups', ['route' => 'working-groups.index',]);

            $menu->add('Manage', [])->active('manage/*')->data('icon', 'la la-sliders');
            $menu->manage->add('Departments', ['route' => 'departments.index',])->data('permission', 'list departments');
            $menu->manage->add('Districts', ['route' => 'districts.index',])->data('permission', 'list districts');


            $menu->add('Security', [])->active('security/*')->data('icon', 'la la-shield');
            $menu->security->add('Roles', ['route' => 'roles.index',])->data('permission', 'list roles');
            $menu->security->add('Permissions', ['route' => 'permissions.index',])->data('permission', 'list permissions');


            $menu->add('System', [])->active('system/*')->data('icon', 'la la-cog');
            $menu->system->add('Types', ['route' => 'types.index']);
            $menu->system->add('Categories', ['route' => 'categories.index']);
            $menu->system->add('State Colors', ['route' => 'state-colors.index']);
            $menu->system->add('Statuses', ['route' => 'statuses.index']);

            $menu->add('Reports', [])
                ->data('icon', 'la la-area-chart');


        });

        return $next($request);
    }
}
