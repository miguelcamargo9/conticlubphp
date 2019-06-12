<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $design_id
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 * @property Design $design
 * @property InvoiceReference[] $invoiceReferences
 */
class Rin extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rin';

    /**
     * @var array
     */
    protected $fillable = ['design_id', 'name','points_gr','points_rd', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function design()
    {
        return $this->belongsTo('App\Design');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoiceReferences()
    {
        return $this->hasMany('App\InvoiceReference');
    }
        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rinPointsByPerfils()
    {
        return $this->hasMany('App\RinPointsByProfile');
    }
}
