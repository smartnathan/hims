<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemBrandManufacturer extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_brand_manufacturers';

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

    public function user()
        {
            return $this->belongsTo(User::class, 'added_by');
        }
    public function itemBrands()
    {
        return $this->hasMany(ItemBrand::class);
    }
}
