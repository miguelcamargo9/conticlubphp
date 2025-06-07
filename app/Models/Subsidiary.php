<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $cities_id
 * @property string $name
 * @property string $address
 * @property string $type
 * @mixin Eloquent
 */
class Subsidiary extends Model
{

  /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'subsidiary';

    /**
     * @var array
     */
    protected $fillable = ['cities_id', 'name', 'address', 'type', 'updated_at', 'created_at'];

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo('App\Models\Cities', 'cities_id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany('App\User');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo('App\Models\Profile', 'profiles_id');
    }
}
