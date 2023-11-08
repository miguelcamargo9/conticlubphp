<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $invoice_id
 * @property int $tire_id
 * @property int $amount
 * @property Invoice $invoice
 * @property Tire $tire
 * @property string $points
 * @mixin Eloquent
 */
class InvoiceReferences extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'tire_id', 'amount'];

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo('App\Models\Invoice');
    }

    /**
     * @return BelongsTo
     */
    public function tire(): BelongsTo
    {
        return $this->belongsTo('App\Models\Tire');
    }
}
