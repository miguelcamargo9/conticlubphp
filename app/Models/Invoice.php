<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $users_id
 * @property string $sale_date
 * @property int $number
 * @property string $price
 * @property string $image
 * @property User $user
 * @property InvoiceReference[] $invoiceReferences
 * @property Point[] $points
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoiceReferences()
    {
        return $this->hasMany('App\InvoiceReferences');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function points()
    {
        return $this->hasMany('App\Points');
    }
}
