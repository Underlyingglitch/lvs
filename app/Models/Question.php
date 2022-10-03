<?php

namespace App\Models;

use App\Models\Buddie;
use App\Models\Leerling;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    public function leerling()
    {
        return $this->belongsTo(Leerling::class);
    }

    public function buddie()
    {
        return $this->belongsTo(Buddie::class);
    }

    public function getOwner()
    {
        if ($this->leerling_id != null) {
            return $this->leerling->user->name;
        }
        return $this->buddie->user->name;
    }

    public function getOwnerType()
    {
        if ($this->leerling_id != null) {
            return 'Leerling';
        }
        return 'Buddie';
    }
}
