<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idwish_list
 * @property int $product_id
 * @property int $users_id
 * @property Product $product
 * @property User $user
 */
class WishList extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'wish_list';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idwish_list';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'users_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
