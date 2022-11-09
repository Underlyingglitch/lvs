<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        if ($user->get_role() == 'teacher') return true;
        return;
    }

    public function viewOwn(User $user)
    {
        if ($user->get_role() == "buddie") return true;
        return;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        if ($user->id === $model->id) return Response::allow();
        if ($user->id === $model->buddie_id) return Response::allow();
        if ($user->get_role() == "teacher") return Response::allow();

        return Response::deny('Je hebt geen toegang tot deze gebruiker');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if ($user->get_role() == 'teacher') return Response::allow();
        return Response::deny('Je mag geen gebruikers aanmaken');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        if ($user->id === $model->id) return Response::allow();
        if ($user->get_role() == 'teacher') return Response::allow();
        return Response::deny('Je mag geen bewerkingen aan gebruikers uitvoeren');
    }

    public function changepassword(User $user, User $model)
    {
        if ($user->id === $model->buddie_id) return Response::allow();
        if ($user->get_role() == 'teacher') return Response::allow();
        return Response::deny('Je mag geen wachtwoorden opnieuw instellen');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return Response::deny('Je mag geen gebruikers verwijderen');
    }
}
