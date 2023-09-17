<?php

namespace App\Models;

use Eloquent;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property User[] $users
 * @mixin Eloquent
 */
class Cities extends Model
{

  /**
   * @var array
   */
    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function subsidiary(): HasMany
    {
        return $this->hasMany('App\Models\Subsidiary', 'subsidiary_id');
    }
}
