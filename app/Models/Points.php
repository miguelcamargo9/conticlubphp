<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $invoice_id
 * @property int $points
 * @property string $sum_date
 * @property string $state
 * @property Invoice $invoice
 * @property PointsMovimentsDetail[] $pointsMovimentsDetails
 */
class Points extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'points', 'sum_date', 'state'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pointsMovimentsDetails()
    {
        return $this->hasMany('App\PointsMovimentsDetail', 'points_id');
    }
}
