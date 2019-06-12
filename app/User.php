<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $profiles_id
 * @property int $cities_id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $identification_number
 * @property string $identification_type
 * @property boolean $state
 * @property int $points
 * @property City $city
 * @property Profile $profile
 * @property Invoice[] $invoices
 * @property WishList[] $wishLists
 */
class User extends Authenticatable {

  use HasApiTokens,
      Notifiable;

  /**
   * @var array
   */
  protected $fillable = ['profiles_id', 'cities_id', 'name', 'nickname', 'email', 'identification_number', 'identification_type', 'state', 'points'];

  public function findForPassport($username) {
    //dd(bcrypt("1234"));
    return $this->where('identification_number', $username)->first();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function subsidiary() {
    return $this->belongsTo('App\Models\Subsidiaries', 'subsidiary_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function profile() {
    return $this->belongsTo('App\Profiles', 'profiles_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function invoices() {
    return $this->hasMany('App\Invoice', 'users_id');
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function wishLists() {
    return $this->hasMany('App\WishList', 'users_id');
  }
  
}
