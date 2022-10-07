<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolYear extends Model
{
    use HasFactory;

    public function absence_requests()
    {
        return $this->hasMany(AbsenceRequest::class);
    }
}
