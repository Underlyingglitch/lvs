<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->get_role() == "admin") return true;
    }
 
    public function viewAny(User $user)
    {
        if ($user->get_role() == "teacher") return true;
        return;
    }

    public function view(User $user, Conversation $conversation)
    {
        $users = $conversation->invitees->pluck('id')->toArray();
        $users[] = $conversation->organizer_id;
        
        if (in_array($user->id, $users)) return Response::allow();
        return Response::deny('Je hebt geen toegang tot dit gesprek');
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Conversation $conversation)
    {
        if ($user->id == $conversation->organizer_id) return Response::allow();
        return Response::deny('Je mag geen wijzigingen aanbrengen aan dit gesprek');
    }
}
