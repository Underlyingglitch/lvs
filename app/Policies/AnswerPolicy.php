<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;
    
    public function before(User $user, $ability)
    {
        if ($user->get_role() == "admin") return true;
    }

    public function create(User $user)
    {
        if ($user->get_role() != 'student') return Response::allow();
        return Response::deny('Je mag geen antwoorden op vragen toevoegen');
    }

    public function delete(User $user, Answer $answer)
    {
        if ($user->get_role() == 'teacher') return Response::allow();
        return Response::deny('Je mag geen antwoorden op vragen verwijderen');
    }
}
