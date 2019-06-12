<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 * @property Design[] $designs
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function designs()
    {
        return $this->hasMany('App\Design');
    }
}
