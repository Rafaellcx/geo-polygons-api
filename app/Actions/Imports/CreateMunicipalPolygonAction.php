<?php

namespace App\Actions\Imports;

use Illuminate\Support\Facades\DB;

class CreateMunicipalPolygonAction
{
    public static function handle(string $uf, string $name, string $polygon) : bool
    {
        $now = now();

        $result = DB::table('municipal_geometry')->insert(
            array(
                'name' => $name,
                'geom' => DB::raw("ST_MakePolygon(ST_GeomFromText('LINESTRING($polygon)'))"),
                'uf' => $uf,
                'created_at' => $now,
                'updated_at' => $now,
            )
        );

        return $result;
    }

}
