<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

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
    protected $fillable = ['item_category_id', 'item_brand_id', 'item_group_id', 'name', 'code', 'description', 'price', 'has_instances', 'is_active', 'tag', 'quantity', 'added_by', 'oem', 'warranty_terms', 'model_number', 'item_uom_id'];

    
}
