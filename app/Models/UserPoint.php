<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserPoint extends Model
{
    use HasFactory;

    protected $table = 'user_points';

    protected $primaryKey = 'id';

    protected $attributes = ['latitude','longitude','municipal_id','geom'];

    public function municipal_geometry(): HasOne
    {
        return $this->hasOne(MunicipalGeometry::class, 'id', 'municipal_id');
    }
}
