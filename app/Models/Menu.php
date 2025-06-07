<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $id_father
 * @property ProfilesMenu[] $profilesMenus
 * @mixin Eloquent
 */
class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_father'];

    /**
     * @return HasMany
     */
    public function profilesMenus(): HasMany
    {
        return $this->hasMany('App\Models\ProfilesMenu');
    }
}
