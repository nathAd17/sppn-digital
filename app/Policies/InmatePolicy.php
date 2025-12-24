<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inmate;

class InmatePolicy
{
    /**
     * Create a new policy instance.
     */
        public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view
    }

    /**
     * Determine if the user can view the inmate.
     */
    public function view(User $user, Inmate $inmate): bool
    {
        return $user->prison_id === $inmate->prison_id;
    }

    /**
     * Determine if the user can create inmates.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'kepala_lapas', 'kasubsi']);
    }

    /**
     * Determine if the user can update the inmate.
     */
    public function update(User $user, \App\Models\Inmate $inmate): bool
    {
        return $user->prison_id === $inmate->prison_id &&
               in_array($user->role, ['admin', 'kepala_lapas', 'kasubsi']);
    }

    /**
     * Determine if the user can delete the inmate.
     */
    public function delete(User $user, Inmate $inmate): bool
    {
        return $user->prison_id === $inmate->prison_id &&
               in_array($user->role, ['admin', 'kepala_lapas']);
    }
}
