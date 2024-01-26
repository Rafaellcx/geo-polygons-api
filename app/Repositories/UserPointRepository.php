<?php

namespace App\Repositories;

use App\Models\UserPoint;
use App\Repositories\Contracts\UserPointRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserPointRepository implements UserPointRepositoryContract
{
    private UserPoint $model;
    /**
     * @param UserPoint $model
     */
    public function __construct(UserPoint $model)
    {
        $this->model = $model;
    }

    public function index(array $fields): Collection|LengthAwarePaginator|array
    {
        $municipalGeomety = $this->model->query()->with(['municipal_geometry']);

        if (isset($fields['perpage'])) return $municipalGeomety->paginate($fields['perpage']);

        return $municipalGeomety->get();
    }

    public function find(int $id): Model|Collection|Builder|array|null
    {
        return $this->model->query()->with(['municipal_geometry'])
            ->find($id);
    }

    public function save(array $fields)
    {
        $now = now();
        $polygon = $fields['geom'];
        return DB::table('user_points')->insert(
            array(
                'municipal_id' => $fields['municipal_id'],
                'geom' => DB::raw("ST_MakePolygon(ST_GeomFromText('LINESTRING($polygon)'))"),
                'latitude' => $fields['latitude'],
                'longitude' => $fields['longitude'],
                'created_at' => $now,
                'updated_at' => $now,
            )
        );
    }

    public function update(int $id, array $fields): int
    {
        $now = now();
        $polygon = $fields['geom'];
        return DB::table('user_points')
            ->where('id', $fields['id'])
            ->update(
                array(
                    'municipal_id' => $fields['municipal_id'],
                    'geom' => DB::raw("ST_MakePolygon(ST_GeomFromText('LINESTRING($polygon)'))"),
                    'latitude' => $fields['latitude'],
                    'longitude' => $fields['longitude'],
                    'created_at' => $now,
                    'updated_at' => $now,
                )
            );
    }

    public function delete(int $id)
    {
        return $this->model->query()->find($id)->delete();
    }
}
