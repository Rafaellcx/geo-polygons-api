<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MunicipalGeometry extends Model
{
    use HasFactory;

    protected $table = 'municipal_geometry';

    protected $primaryKey = 'id';

    protected $attributes = ['name','uf','geom'];

    public function user_point(): HasMany
    {
        return $this->hasMany(UserPoint::class,'municipal_id','id');
    }
}
