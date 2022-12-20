<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notes'
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
