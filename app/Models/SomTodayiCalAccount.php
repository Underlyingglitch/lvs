<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SomTodayiCalAccount extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $table = "somtoday_ical_accounts";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
