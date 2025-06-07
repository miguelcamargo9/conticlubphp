<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $product_categories_id
 * @property string $name
 * @property string $image
 * @property int $points
 * @property string $state
 * @property ProductCategory $productCategory
 * @property ProductImage[] $productImages
 * @property WishList[] $wishLists
 * @mixin Eloquent
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * @var array
     */
    protected $fillable = ['product_categories_id', 'name', 'image', 'points', 'state'];

    /**
     * @return BelongsTo
     */
    public function productCategory(): BelongsTo
    {
        return $this->belongsTo('App\Models\ProductCategory', 'product_categories_id');
    }

    /**
     * @return HasMany
     */
    public function productImages(): HasMany
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    /**
     * @return HasMany
     */
    public function wishLists(): HasMany
    {
        return $this->hasMany('App\Models\WishList');
    }
}
