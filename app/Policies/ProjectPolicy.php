<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role == "admin" && $ability != 'viewOwn') return true;
    }

    public function viewAny(User $user)
    {
        //
    }

    public function viewOwn(User $user)
    {
        if ($user->role == 'student') return true;
        return;
    }

    public function view(User $user, Project $project)
    {
        if ($user->role == 'teacher') return Response::allow();
        if ($user->id == $project->user_id) return Response::allow();
        if ($user->id == $project->user->buddie_id) return Response::allow();
        return Response::deny('Je mag dit project niet bekijken');
    }
  
    public function create(User $user)
    {
        if ($user->role == 'student') return Response::allow();
        return Response::deny('Je mag geen projecten aanmaken');
    }
   
    public function update(User $user, Project $project)
    {
        //
    }

    public function delete(User $user, Project $project)
    {
        //
    }
}
