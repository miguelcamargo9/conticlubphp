<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $cities_id
 * @property string $name
 * @property string $address
 * @property string $type
 * @property string $updated_at
 * @property string $created_at
 * @property City $city
 * @property User[] $users
 */
class Subsidiaries extends Model {

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
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function city() {
    return $this->belongsTo('App\Cities', 'cities_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users() {
    return $this->hasMany('App\User');
  }

  public function profile() {
    return $this->belongsTo('App\Profiles', 'profiles_id');
  }

}
