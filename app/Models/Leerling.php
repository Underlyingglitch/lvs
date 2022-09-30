<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
