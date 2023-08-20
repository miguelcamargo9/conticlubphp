<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $design_id
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 * @property Design $design
 * @property InvoiceReferences[] $invoiceReferences
 * @mixin Eloquent
 */
class Tire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tire';

    /**
     * @var array
     */
    protected $fillable = ['design_id', 'name','points_gr','points_rd', 'updated_at', 'created_at'];

    /**
     * @return BelongsTo
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo('App\Models\Design');
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
    public function tirePointsByProfile(): HasMany
    {
        return $this->hasMany('App\Models\TirePointsByProfile');
    }
}
