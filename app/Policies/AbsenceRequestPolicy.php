<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AbsenceRequest;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsenceRequestPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->get_role() == "admin") return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->get_role() == 'teacher') return Response::allow();
        return Response::deny('Geen toegang');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsenceRequest  $absenceRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AbsenceRequest $absenceRequest)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsenceRequest  $absenceRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AbsenceRequest $absenceRequest)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsenceRequest  $absenceRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AbsenceRequest $absenceRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsenceRequest  $absenceRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AbsenceRequest $absenceRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsenceRequest  $absenceRequest
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AbsenceRequest $absenceRequest)
    {
        //
    }
}
