<?php

namespace App\Models;

use App\Models\User;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Question extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
}
