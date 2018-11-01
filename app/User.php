<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'email',
        'password',
        'othername',
        'surname',
        'gender',
        'lga_id',
        'occupation_id',
        'designation',
        'address',
        'nationality_id',
        'vehicle_number',
        'mobile_number',
        'added_by',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
    public function bookings()
    {
        return $this->hasOne(Booking::class)->orderBy('id', 'desc');
    }

    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class)->orderBy('id', 'desc');
    // }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }
    public function menuorders()
    {
        return $this->hasMany(Menuorder::class)->orderBy('id', 'desc');
    }

    public function transactionHistories()
    {
        return $this->hasMany(GuestTransactionHistory::class)->orderByDesc('id');
    }
}
