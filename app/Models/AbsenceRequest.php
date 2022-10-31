<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class AbsenceRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $casts = [
        'datetime' => 'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
}
