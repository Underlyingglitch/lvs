<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class, 'school_year_id');
    }
}
