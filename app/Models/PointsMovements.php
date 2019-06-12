<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $points
 * @property string $type_movement
 * @property string $date_movement
 * @property PointsMovimentsDetail[] $pointsMovimentsDetails
 */
class PointsMovements extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['points', 'type_movement', 'date_movement'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pointsMovimentsDetails()
    {
        return $this->hasMany('App\PointsMovimentsDetail', 'points_movements_id');
    }
}
