<?php

namespace App\Policies;

use App\User;
use App\Incident;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class IncidentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the incident.
     *
     * @param  User  $user
     * @param  Incident  $incident
     * @return mixed
     */
    public function view(User $user, Incident $incident)
    {
        return true;
    }

    /**
     * Determine whether the user can create incidents.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create fault');
    }

    /**
     * Determine whether the user can update the incident.
     *
     * @param  User  $user
     * @param  Incident  $incident
     * @return mixed
     */
    public function update(User $user, Incident $incident)
    {
        return $user->id === $incident->user_id || $user->hasAnyRole(['administrator', 'super-administrator']);
    }

    /**
     * Determine whether the user can delete the incident.
     *
     * @param  User  $user
     * @param  Incident  $incident
     * @return mixed
     */
    public function delete(User $user, Incident $incident)
    {
        return $user->id === $incident->user_id || $user->hasAnyRole(['administrator', 'super-administrator']);
    }

    /**
     * Determine whether the user can restore the incident.
     *
     * @param  User  $user
     * @param  Incident  $incident
     * @return mixed
     */
    public function restore(User $user, Incident $incident)
    {
        return $user->id === $incident->user_id;
    }

    /**
     * Determine whether the user can permanently delete the incident.
     *
     * @param  User  $user
     * @param  Incident  $incident
     * @return mixed
     */
    public function forceDelete(User $user, Incident $incident)
    {
        return $user->hasAnyRole(['administrator', 'super-administrator']);
    }
}
