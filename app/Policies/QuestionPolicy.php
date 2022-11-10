<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role == "admin") return true;
    }

    public function viewAny(User $user)
    {
        if (in_array($user->role, ['teacher', 'buddie'])) return true;
        return;
    }

    public function viewOwn(User $user)
    {
        if ($user->role == 'student') return true;
        return;
    }

    public function view(User $user, Question $question)
    {
        if ($this->viewAny($user)) return Response::allow();
        if ($user->id == $question->user_id) return Response::allow();
        return Response::deny('Je mag deze vraag niet bekijken');
    }

    public function create(User $user)
    {
        if (in_array($user->role, ['student', 'buddie'])) return Response::allow();
        return Response::deny('Je mag geen nieuwe vragen aanmaken');
    }

    public function delete(User $user)
    {
        if ($user->role == 'teacher') return Response::allow();
        return Response::deny('Je mag geen vragen verwijderen');
    }

    public function publish(User $user)
    {
        if ($user->role == 'teacher') return Response::allow();
        return Response::deny('Je mag geen vragen publiceren');
    }
}
