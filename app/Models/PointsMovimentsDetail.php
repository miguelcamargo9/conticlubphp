<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $points_id
 * @property int $points_movements_id
 * @property int $points
 * @property Point $point
 * @property PointsMovement $pointsMovement
 */
class PointsMovimentsDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'points_movements_detail';

    /**
     * @var array
     */
    protected $fillable = ['points_id', 'points_movements_id', 'points'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function point()
    {
        return $this->belongsTo('App\Models\Point', 'points_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointsMovement()
    {
        return $this->belongsTo('App\Models\PointsMovement', 'points_movements_id');
    }
}
