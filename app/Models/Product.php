<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategories', 'product_categories_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages()
    {
        return $this->hasMany('App\ProductImages');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishLists()
    {
        return $this->hasMany('App\WishList');
    }
}
