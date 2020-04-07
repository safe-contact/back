<?php

namespace App;

use App\Models\Meet;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Uuids;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sick', 'deviceId', 'sickDate', 'recovery_at', 'symptom_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deviceId'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Recupère les meetings ou la personne a rencontré
     */
    public function meets()
    {
        return $this->hasMany(Meet::class, 'userId')->orderBy('meetingDate', 'desc');
    }

    /**
     * Récupère les meetings où la personne a été rencontré
     */
    public function meeted()
    {
        return $this->hasMany(Meet::class, 'meetedUserId')->orderBy('meetingDate', 'desc');
    }

    /**
     * If person be sick -> hassymptom
     */
    public function hasSymptom(): bool
    {
        return $this->symptom_at ? true : false;
    }

    public function hasRecovered(): bool
    {
        return $this->recovery_at ? true : false;
    }
}
