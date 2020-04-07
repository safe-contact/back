<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meet extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'meetedUserId', 'meetingDate', 'rssi'
    ];


    protected $dates = [
        // 'meetingDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function userMeeted()
    {
        return $this->belongsTo(User::class, 'meetedUserId');
    }

    public function getMeetingDateAttribute($value)
    {
        return new \Carbon\Carbon($value);
    }
}
