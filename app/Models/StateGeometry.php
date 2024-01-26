<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateGeometry extends Model
{
    use HasFactory;

    protected $table = 'state_geometry';
    protected $fillable = ['name','geom'];
}
