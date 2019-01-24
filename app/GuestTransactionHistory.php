<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestTransactionHistory extends Model
{
    //

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
