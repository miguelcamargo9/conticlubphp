<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $profiles_id
 * @property int $menu_id
 * @property Menu $menu
 * @property Profile $profile
 */
class ProfilesMenu extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_menu';

    /**
     * @var array
     */
    protected $fillable = ['profiles_id', 'menu_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo('App\Models\Models\Menu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo('App\Models\Models\Profile', 'profiles_id');
    }
}
