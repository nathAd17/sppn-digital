<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assessment;

class AssessmentPolicy
{
    /**
     * Determine if the user can view any assessments.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view the assessment.
     */
    public function view(User $user, Assessment $assessment): bool
    {
        return $user->prison_id === $assessment->prison_id;
    }

    /**
     * Determine if the user can create assessments.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'kasubsi', 'wali_pemasyarakatan', 'petugas']);
    }

    /**
     * Determine if the user can update the assessment.
     */
    public function update(User $user, Assessment $assessment): bool
    {
        if ($user->prison_id !== $assessment->prison_id) {
            return false;
        }

        // Only creator or authorized roles can update
        return $assessment->created_by === $user->id ||
               in_array($user->role, ['admin', 'kasubsi']);
    }

    /**
     * Determine if the user can delete the assessment.
     */
    public function delete(User $user, Assessment $assessment): bool
    {
        return $user->prison_id === $assessment->prison_id &&
               in_array($user->role, ['admin', 'kepala_lapas']) &&
               $assessment->status === 'draft';
    }

    /**
     * Determine if the user can approve the assessment.
     */
    public function approve(User $user, Assessment $assessment): bool
    {
        return $user->prison_id === $assessment->prison_id &&
               in_array($user->role, ['admin', 'kepala_lapas', 'kasubsi']);
    }
}
