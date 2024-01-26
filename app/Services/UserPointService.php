<?php

namespace App\Services;

use App\Http\Helpers\JsonFormat;
use App\Http\Resources\UserPointResource;
use App\Repositories\Contracts\UserPointRepositoryContract;
use App\Services\Contracts\UserPointServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserPointService implements UserPointServiceContract

{
    protected UserPointRepositoryContract $userPointRepository;

    /**
     * @param UserPointRepositoryContract $userPointRepository
     */
    public function __construct(UserPointRepositoryContract $userPointRepository)
    {
        $this->userPointRepository = $userPointRepository;
    }

    public function index(array $fields=[]): AnonymousResourceCollection
    {
        return UserPointResource::collection($this->userPointRepository->index($fields));
    }

    public function find(int $id): JsonResponse
    {
        $userPoint = $this->userPointRepository->find($id);

        if (!$userPoint) {
            return JsonFormat::error('User point not found.');
        }

        return response()->json(new UserPointResource($userPoint));
    }

    public function save(array $fields): JsonResponse
    {
        try {
            $this->userPointRepository->save($fields);

            return JsonFormat::success('User Point was saved successfully.',[],201);
        } catch (Exception) {

            return JsonFormat::error('Oops, User Point not saved.');
        }
    }

    public function update(int $id, array $fields): JsonResponse
    {
        try {
            $this->userPointRepository->update($id, $fields);
        } catch (Exception) {

            return JsonFormat::error('Error when trying to update the data.');
        }
        return JsonFormat::success('User Point has been updated successfully.');
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $this->userPointRepository->delete($id);
        } catch (Exception) {

            return JsonFormat::error('Oops, User Point was not deleted.');
        }

        return JsonFormat::success('',[],202);
    }
}
