<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class Student extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buddie()
    {
        return $this->belongsTo(Buddie::class);
    }
}
