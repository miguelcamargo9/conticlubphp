<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 * @property Design[] $designs
 * @mixin Eloquent
 */
class Brand extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brand';

    /**
     * @var array
     */
    protected $fillable = ['name', 'updated_at', 'created_at'];

    /**
     * @return HasMany
     */
    public function designs(): HasMany
    {
        return $this->hasMany('App\Models\Design');
    }
}
