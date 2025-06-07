<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property ProfilesMenu[] $profilesMenus
 * @property User[] $users
 * @method static Builder|Profile notAdmin()
 * @mixin Eloquent
 */
class Profile extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function profilesMenus(): HasMany
    {
        return $this->hasMany('App\Models\ProfilesMenu', 'profiles_id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany('App\User', 'profiles_id');
    }

    public function scopeNotAdmin(Builder $query): Builder
    {
        return $query->whereNotIn(
            'name',
            [
                config('constants.profiles.admin'),
                config('constants.profiles.comprador'),
                config('constants.profiles.aprobador')
            ]
        );
    }
}
