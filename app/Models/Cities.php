<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property User[] $users
 */
class Cities extends Model {

  /**
   * @var array
   */
  protected $fillable = ['name'];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function subsidiary() {
    return $this->hasMany('App\Models\Subsidiary', 'subsidiary_id');
  }

}
