<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $rin_id
 * @property int $profiles_id
 * @property int $points
 * @property Profile $profile
 * @property Rin $rin
 */
class RinPointsByProfile extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rin_points_by_perfil';

    /**
     * @var array
     */
    protected $fillable = ['rin_id', 'profiles_id', 'points'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo('App\Profile', 'profiles_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rin()
    {
        return $this->belongsTo('App\Rin');
    }
}
