<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $idwish_list
 * @property int $product_id
 * @property int $users_id
 * @property Product $product
 * @property User $user
 * @mixin Eloquent
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
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
