<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsenceRequest extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
