<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property ProfilesMenu[] $profilesMenus
 * @property User[] $users
 */
class Profiles extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profilesMenus()
    {
        return $this->hasMany('App\Models\ProfilesMenu', 'profiles_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', 'profiles_id');
    }

    public function scopeNotAdmin($query)
    {
        return $query->whereNotIn('name', [config('constants.profiles.admin'), config('constants.profiles.comprador'), config('constants.profiles.aprobador')]);
    }
}
