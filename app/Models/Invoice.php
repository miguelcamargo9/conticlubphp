<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $users_id
 * @property string $sale_date
 * @property int $number
 * @property string $price
 * @property string $image
 * @property int $subsidiary_id
 * @property User $user
 * @property InvoiceReference[] $invoiceReferences
 * @property Point[] $points
 * @property string $state
 * @property string $rejection_comment
 * @mixin Eloquent
 */
class Invoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice';

    /**
     * @var array
     */
    protected $fillable = ['users_id', 'sale_date', 'number', 'price', 'image'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return HasMany
     */
    public function invoiceReferences(): HasMany
    {
        return $this->hasMany('App\Models\InvoiceReference');
    }

    /**
     * @return HasMany
     */
    public function points(): HasMany
    {
        return $this->hasMany('App\Models\Point');
    }
}
