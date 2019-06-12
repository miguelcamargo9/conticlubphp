<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $invoice_id
 * @property int $rin_id
 * @property int $amount
 * @property Invoice $invoice
 * @property Rin $rin
 */
class InvoiceReferences extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['invoice_id', 'rin_id', 'amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rin()
    {
        return $this->belongsTo('App\Rin');
    }
}
