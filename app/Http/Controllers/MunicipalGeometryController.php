<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateCoordinatesRequest;
use App\Services\Contracts\MunicipalServiceContract;
use Illuminate\Http\Request;

class MunicipalGeometryController extends Controller
{
    protected MunicipalServiceContract $municipalService;

    /**
     * @param MunicipalServiceContract $municipalService
     */
    public function __construct(MunicipalServiceContract $municipalService)
    {
        $this->municipalService = $municipalService;
    }

    public function find(ValidateCoordinatesRequest $request)
    {
        return $this->municipalService->find(latitude: $request->input('latitude'),longitude: $request->input('longitude'));
    }
}
