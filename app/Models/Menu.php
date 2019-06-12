<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_father
 * @property ProfilesMenu[] $profilesMenus
 */
class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_father'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profilesMenus()
    {
        return $this->hasMany('App\ProfilesMenu');
    }
}
