<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function invitees()
    {
        return $this->belongsToMany(User::class);
    }

    public function preparations()
    {
        return $this->hasMany(ConversationPreparation::class);
    }

    public function my_preparation()
    {
        return $this->hasOne(ConversationPreparation::class)->where('user_id',auth()->user()->id);
    }
}
