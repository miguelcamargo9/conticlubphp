<?php

namespace App;

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
    protected $table = 'points_moviments_detail';

    /**
     * @var array
     */
    protected $fillable = ['points_id', 'points_movements_id', 'points'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function point()
    {
        return $this->belongsTo('App\Point', 'points_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pointsMovement()
    {
        return $this->belongsTo('App\PointsMovement', 'points_movements_id');
    }
}
