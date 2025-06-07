<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $profiles_id
 * @property int $menu_id
 * @property Menu $menu
 * @property Profile $profile
 * @mixin Eloquent
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
     * @return BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo('App\Models\Menu');
    }

    /**
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo('App\Models\Profile', 'profiles_id');
    }
}
