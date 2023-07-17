<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $users_id
 * @property string $state
 * @property string $comment
 * @property int $approver_id
 * @property string $updated_at
 * @property string $created_at
 * @property Product $product
 * @property User $user
 */
class ChangePoints extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'users_id', 'state', 'comment', 'approver_id', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
