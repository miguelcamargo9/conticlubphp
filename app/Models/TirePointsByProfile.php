<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $tire_id
 * @property int $profiles_id
 * @property int $points
 * @property int $points_general
 * @property int points_uhp
 * @property int total_points
 * @property Profile $profile
 * @property Tire $tire
 * @mixin Eloquent
 */
class TirePointsByProfile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tire_points_by_profile';

    /**
     * @var array
     */
    protected $fillable = ['tire_id', 'profiles_id', 'points'];

    /**
     * @return BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo('App\Models\Profile', 'profiles_id');
    }

    /**
     * @return BelongsTo
     */
    public function tire(): BelongsTo
    {
        return $this->belongsTo('App\Models\Tire');
    }
}
