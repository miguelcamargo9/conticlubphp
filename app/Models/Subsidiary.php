<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $cities_id
 * @property string $name
 * @property string $address
 * @property string $type
 * @property City $city
 * @property User[] $users
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
    protected $fillable = ['cities_id', 'name', 'address', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Cities', 'cities_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
