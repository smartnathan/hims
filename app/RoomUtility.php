<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomUtility extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'room_utilities';

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
    protected $fillable = ['name', 'added_by'];

    public function rooms()
    {
        return $this->belongsToMany(Rooms::class)->withTimeStamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
