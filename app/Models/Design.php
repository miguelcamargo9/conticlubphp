<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $brand_id
 * @property string $name
 * @property string $image
 * @property string $updated_at
 * @property string $created_at
 * @property Brand $brand
 * @property Rin[] $rins
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rins()
    {
        return $this->hasMany('App\Rin');
    }
}
