<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Auth\Access\Response;
use App\Models\ConversationPreparation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPreparationPolicy
{
    use HandlesAuthorization;
 
    public function create(User $user, Conversation $conversation)
    {
        $users = $conversation->invitees->pluck('id')->toArray();
        $users[] = $conversation->organizer_id;
        
        if ($conversation->report) return Response::deny('Dit gesprek is al afgesloten');
        if (in_array($user->id, $users)) return Response::allow();
        return Response::deny('Je mag geen voorbereiding toevoegen');
    }
}
