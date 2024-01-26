<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerPageRequest;
use App\Http\Requests\StoreUserPointRequest;
use App\Http\Requests\UpdateUserPointRequest;
use App\Services\Contracts\UserPointServiceContract;
use Illuminate\Http\Request;

class UserPointController extends Controller
{
    protected UserPointServiceContract $userPointService;

    /**
     * @param UserPointServiceContract $userPointService
     */
    public function __construct(UserPointServiceContract $userPointService)
    {
        $this->userPointService = $userPointService;
    }

    public function index(PerPageRequest $request)
    {
        return $this->userPointService->index($request->validated());
    }

    public function show($id)
    {
        return $this->userPointService->find($id);
    }

    public function store(StoreUserPointRequest $request)
    {
        return $this->userPointService->save($request->validated());
    }

    public function update(int $id, UpdateUserPointRequest $request)
    {
        return $this->userPointService->update($id, $request->validated());
    }

    public function destroy(int $id)
    {
        return $this->userPointService->delete($id);
    }
}
