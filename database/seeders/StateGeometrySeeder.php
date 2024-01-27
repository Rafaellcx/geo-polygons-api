<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateGeometrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "INSERT INTO state_geometry (name, geom, created_at, updated_at)
            SELECT
                CASE
                    WHEN uf = 'SP' THEN 'SÃO PAULO'
                    WHEN uf = 'MG' THEN 'MINAS GERAIS'
                    ELSE uf
                END AS name,
                ST_Union(geom) AS geom,
                NOW() AS created_at,
                NOW() AS updated_at
            FROM municipal_geometry
            WHERE uf IN ('SP', 'MG')
            GROUP BY uf";

        // Executing the query
        DB::statement($sql);
    }
}
