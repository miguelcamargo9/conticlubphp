<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $brand_id
 * @property string $name
 * @property string $image
 * @property string $updated_at
 * @property string $created_at
 * @property Brand $brand
 * @property Rin[] $wheels
 * @mixin Eloquent
 */
class Design extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'design';

    /**
     * @var array
     */
    protected $fillable = ['brand_id', 'name', 'image', 'updated_at', 'created_at'];

    /**
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo('App\Models\Brand');
    }

    /**
     * @return HasMany
     */
    public function wheels()
    {
        return $this->hasMany('App\Models\Rin');
    }
}
