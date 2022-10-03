<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buddie extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leerlingen()
    {
        return $this->hasMany(Leerling::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
