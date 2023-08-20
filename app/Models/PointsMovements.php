<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $points
 * @property string $type_movement
 * @property string $date_movement
 * @property PointsMovementsDetail[] $pointsMovementsDetails
 * @mixin Eloquent
 */
class PointsMovements extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['points', 'type_movement', 'date_movement'];

    /**
     * @return HasMany
     */
    public function pointsMovementsDetails(): HasMany
    {
        return $this->hasMany('App\Models\PointsMovementsDetail', 'points_movements_id');
    }
}
