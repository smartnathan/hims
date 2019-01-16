<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['room_id', 'arrival_date', 'departure_date', 'user_id', 'checked_in_by', 'checked_out_by', 'paid', 'payment_type_id', 'duration', 'is_cancealed', 'date_cancealed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function staff()
    {
        return $this->belongsTo(User::class, 'checked_in_by', 'id');
    }
    public function menuorders()
    {
        return $this->hasMany(Menuorder::class, 'user_id', 'user_id')->orderBy('id', 'desc');
    }
    
    
}
