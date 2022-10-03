<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Question;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'last_seen',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_role()
    {
        if (count($this->getRoleNames()) > 0) {
            return $this->getRoleNames()[0];
        }
        return '-';
    }

    public function leerling()
    {
        return $this->hasOne(Leerling::class);
    }

    public function buddie()
    {
        return $this->hasOne(Buddie::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getType()
    {
        if ($this->buddy != null) {
            return 'buddie';
        }
        return 'leerling';
    }
}
