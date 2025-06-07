<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $points_id
 * @property int $points_movements_id
 * @property int $points
 * @property Point $point
 * @property PointsMovement $pointsMovement
 * @mixin Eloquent
 */
class PointsMovementsDetail extends Model
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
     * @return BelongsTo
     */
    public function point(): BelongsTo
    {
        return $this->belongsTo('App\Models\Point', 'points_id');
    }

    /**
     * @return BelongsTo
     */
    public function pointsMovement(): BelongsTo
    {
        return $this->belongsTo('App\Models\PointsMovement', 'points_movements_id');
    }
}
