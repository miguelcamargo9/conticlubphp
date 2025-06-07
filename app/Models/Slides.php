<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $path
 * @mixin Eloquent
 */
class Slides extends Model
{
    protected $table = 'slides';
}
