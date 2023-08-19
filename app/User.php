<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticate;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Cities;
use App\Models\Profiles;
use App\Models\Invoice;
use App\Models\WishList;

/**
 * App\User
 *
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
 * @property Cities $city
 * @property Profiles $profile
 * @property Invoice[] $invoices
 * @property WishList[] $wishLists
 * @mixin Eloquent
 */
class User extends Authenticate
{
    use HasApiTokens,
      Notifiable;

    /**
     * @var array
     */
    protected $fillable = ['profiles_id', 'cities_id', 'name', 'nickname', 'email', 'identification_number',
        'identification_type', 'state', 'points'];

    public function findForPassport($username)
    {
        //dd(bcrypt("1234"));
        return $this->where('identification_number', $username)->first();
    }

    /**
     * @return BelongsTo
     */
    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo('App\Models\Subsidiaries', 'subsidiary_id');
    }

    /**
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo('App\Models\Profiles', 'profiles_id');
    }

    /**
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany('App\Models\Invoice', 'users_id');
    }

    /**
     * @return HasMany
     */
    public function wishLists(): HasMany
    {
        return $this->hasMany('App\Models\WishList', 'users_id');
    }
}
