<?php

namespace App\Models;

use App\User;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @mixin Eloquent
 */
class ChangePoints extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'users_id', 'state', 'comment', 'approver_id', 'updated_at', 'created_at'];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
