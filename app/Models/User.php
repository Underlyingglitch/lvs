<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Question;
use App\Models\SchoolYear;
use App\Models\AbsenceRequest;
use Laravel\Sanctum\HasApiTokens;
use App\Models\SomTodayiCalAccount;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasApiTokens, HasFactory, Notifiable;

    protected $auditExclude = [
        'last_seen',
    ];

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

    public function get_role_name()
    {
        $role_names = [
            'admin' => 'Administrator',
            'teacher' => 'Docent',
            'buddie' => 'Buddy',
            'student' => 'Leerling'
        ];
        return $role_names[$this->role];
    }

    public function students() {
        return $this->hasMany(User::class, 'buddie_id', 'id');
    }
    public function buddie() {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function somtoday_ical_account()
    {
        return $this->hasOne(SomTodayiCalAccount::class);
    }

    // NOTE: THIS FEATURE IS DEPRECATED, DO NOT USE
    public function getType()
    {
        dd('DEPRECATED FEATURE getType() WAS USED');
        if ($this->buddy != null) {
            return 'buddie';
        }
        return 'student';
    }

    public function absence_requests()
    {
        return $this->hasMany(AbsenceRequest::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class)->where('school_year_id',SchoolYear::current()->id);
    }

    public function organized_conversations()
    {
        return $this->hasMany(Conversation::class, 'organizer_id', 'id');
    }

    public function invited_conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }
}
