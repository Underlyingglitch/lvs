<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leerling extends Model
{
    use HasFactory;

    protected $table = 'leerlingen';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buddie()
    {
        return $this->belongsTo(Buddie::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
