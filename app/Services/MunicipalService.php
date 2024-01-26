<?php

namespace App\Services;

use App\Http\Resources\MunicipalResource;
use App\Repositories\Contracts\UserPointRepositoryContract;
use App\Services\Contracts\MunicipalServiceContract;
use Illuminate\Support\Facades\DB;

class MunicipalService implements MunicipalServiceContract
{
    protected UserPointRepositoryContract $userPointRepository;

    /**
     * @param UserPointRepositoryContract $userPointRepository
     */
    public function __construct(UserPointRepositoryContract $userPointRepository)
    {
        $this->userPointRepository = $userPointRepository;
    }


    public function find(string $latitude, string $longitude): MunicipalResource
    {
        $latitude = $latitude;
        $longitude = $longitude;

        $result = DB::select(
            "SELECT
                    id, name, ST_AsText(geom) as geometry
                FROM
                    municipal_geometry
                WHERE
                    ST_Contains(geom, ST_SetSRID(ST_MakePoint(?, ?), 4326)) limit(1)",
            [$longitude, $latitude]
        );

        if ($result[0]->id) {
            $polygon = str_replace('POLYGON((','', $result[0]->geometry);
            $polygon = str_replace('))','', $polygon);

            $this->userPointRepository->save([
                'latitude' => $latitude,
                'longitude' => $longitude,
                'municipal_id' => $result[0]->id,
                'geom' => $polygon,
            ]);
        }

        return new MunicipalResource($result[0]);
    }
}
