<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menuses';

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
    protected $fillable = ['menutype_id', 'name', 'price', 'description', 'added_by'];
    public function menutype()
    {
        return $this->belongsTo(Menutype::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }


}
