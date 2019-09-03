<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Profile > [User Name] > Edit User
Breadcrumbs::for('profile.edit', function ($trail, $user) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit', $user->uuid));
});

// Users
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users.index'));
});

// Users > Upload User
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Add User', route('users.create'));
});

// Users > [User Name] > Edit User
Breadcrumbs::for('users.edit', function ($trail, $user) {
    $trail->parent('users.index', $user);
    $trail->push('Edit User', route('users.edit', $user->id));
});
// Departments
Breadcrumbs::for('departments.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Departments', route('departments.index'));
});

// Departments > Upload Department
Breadcrumbs::for('departments.create', function ($trail) {
    $trail->parent('departments.index');
    $trail->push('Add Department', route('departments.create'));
});

// Departments > [Department Name]
Breadcrumbs::for('departments.show', function ($trail, $department) {
    $trail->parent('departments.index');
    $trail->push($department->name, route('departments.show', $department->id));
});

// Departments > [Department Name] > Edit Department
Breadcrumbs::for('departments.edit', function ($trail, $department) {
    $trail->parent('departments.show', $department);
    $trail->push('Edit Department', route('departments.edit', $department->id));
});
// Permissions
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Permissions', route('permissions.index'));
});

// Permissions > Upload Permission
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push('Add Permission', route('permissions.create'));
});

// Permissions > [Permission Name]
Breadcrumbs::for('permissions.show', function ($trail, $permission) {
    $trail->parent('permissions.index');
    $trail->push('View "'. $permission->name . '" Details', route('permissions.show', $permission->id));
});

// Permissions > [Permission Name] > Edit Permission
Breadcrumbs::for('permissions.edit', function ($trail, $permission) {
    $trail->parent('permissions.index', $permission);
    $trail->push('Edit Permission', route('permissions.edit', $permission->id));
});
// Roles
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles.index'));
});

// Roles > Upload Role
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Add Role', route('roles.create'));
});

// Roles > [Role Name]
Breadcrumbs::for('roles.show', function ($trail, $role) {
    $trail->parent('roles.index');
    $trail->push($role->name, route('roles.show', $role->id));
});

// Roles > [Role Name] > Edit Role
Breadcrumbs::for('roles.edit', function ($trail, $role) {
    $trail->parent('roles.index', $role);
    $trail->push('Edit Role', route('roles.edit', $role->id));
});
// Types
Breadcrumbs::for('types.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Types', route('types.index'));
});

// Types > Upload Type
Breadcrumbs::for('types.create', function ($trail) {
    $trail->parent('types.index');
    $trail->push('Add Type', route('types.create'));
});

// Types > [Type Name]
Breadcrumbs::for('types.show', function ($trail, $type) {
    $trail->parent('types.index');
    $trail->push($type->name, route('types.show', $type->id));
});

// Types > [Type Name] > Edit Type
Breadcrumbs::for('types.edit', function ($trail, $type) {
    $trail->parent('types.show', $type);
    $trail->push('Edit Type', route('types.edit', $type->id));
});

// Categories
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Categories', route('categories.index'));
});

// Categories > Upload Category
Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('Add Category', route('categories.create'));
});

// Categories > [Category Name]
Breadcrumbs::for('categories.show', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push($category->name, route('categories.show', $category->id));
});

// Categories > [Category Name] > Edit Category
Breadcrumbs::for('categories.edit', function ($trail, $category) {
    $trail->parent('categories.show', $category);
    $trail->push('Edit Category', route('categories.edit', $category->id));
});

// Incidents
Breadcrumbs::for('incidents.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Incidents', route('incidents.index'));
});

// Incidents > Upload Incident
Breadcrumbs::for('incidents.create', function ($trail) {
    $trail->parent('incidents.index');
    $trail->push('Add Incident', route('incidents.create'));
});

// Incidents > [Incident Name]
Breadcrumbs::for('incidents.show', function ($trail, $incident) {
    $trail->parent('incidents.index');
    $trail->push($incident->name, route('incidents.show', $incident->id));
});

// Incidents > [Incident Name] > Edit Incident
Breadcrumbs::for('incidents.edit', function ($trail, $incident) {
    $trail->parent('incidents.show', $incident);
    $trail->push('Edit Incident', route('incidents.edit', $incident->id));
});

// Incidents > [Incident Name]
Breadcrumbs::for('incidents.engineers', function ($trail, $incident) {
    $trail->parent('incidents.show', $incident);
    $trail->push('Assign to "'.$incident->name.'"', route('incidents.engineers', $incident->id));
});

// State Colors
Breadcrumbs::for('state-colors.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('State Colors', route('state-colors.index'));
});

// State Colors > Upload State Color
Breadcrumbs::for('state-colors.create', function ($trail) {
    $trail->parent('state-colors.index');
    $trail->push('Add State Color', route('state-colors.create'));
});

// State Colors > [State Color Name]
Breadcrumbs::for('state-colors.show', function ($trail, $state_color) {
    $trail->parent('state-colors.index');
    $trail->push($state_color->name, route('state-colors.show', $state_color->id));
});

// State Colors > [State Color Name] > Edit State Color
Breadcrumbs::for('state-colors.edit', function ($trail, $state_color) {
    $trail->parent('state-colors.index', $state_color);
    $trail->push('Edit State Color', route('state-colors.edit', $state_color->id));
});

// Statuses
Breadcrumbs::for('statuses.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Statuses', route('statuses.index'));
});

// Statuses > Upload Status
Breadcrumbs::for('statuses.create', function ($trail) {
    $trail->parent('statuses.index');
    $trail->push('Add Status', route('statuses.create'));
});

// Statuses > [Status Name]
Breadcrumbs::for('statuses.show', function ($trail, $status) {
    $trail->parent('statuses.index');
    $trail->push($status->name, route('statuses.show', $status->id));
});

// Statuses > [Status Name] > Edit Status
Breadcrumbs::for('statuses.edit', function ($trail, $status) {
    $trail->parent('statuses.index', $status);
    $trail->push('Edit Status', route('statuses.edit', $status->id));
});

// Working Groups
Breadcrumbs::for('working-groups.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Working Groups', route('working-groups.index'));
});

// Working Groups > Upload Working Group
Breadcrumbs::for('working-groups.create', function ($trail) {
    $trail->parent('working-groups.index');
    $trail->push('Add Working Group', route('working-groups.create'));
});

// Working Groups > [Working Group Name]
Breadcrumbs::for('working-groups.show', function ($trail, $working_group) {
    $trail->parent('working-groups.index');
    $trail->push($working_group->name, route('working-groups.show', $working_group->id));
});

// Working Groups > [Working Group Name] > Edit Working Group
Breadcrumbs::for('working-groups.edit', function ($trail, $working_group) {
    $trail->parent('working-groups.show', $working_group);
    $trail->push('Edit Working Group', route('working-groups.edit', $working_group->id));
});
