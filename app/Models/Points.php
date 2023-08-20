<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $invoice_id
 * @property int $points
 * @property string $sum_date
 * @property string $state
 * @property Invoice $invoice
 * @property PointsMovementsDetail[] $pointsMovementsDetails
 * @mixin Eloquent
 */
class Points extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'points', 'sum_date', 'state'];

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo('App\Models\Invoice');
    }

    /**
     * @return HasMany
     */
    public function pointsMovementsDetails(): HasMany
    {
        return $this->hasMany('App\Models\PointsMovementsDetail', 'points_id');
    }
}
