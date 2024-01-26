<?php

namespace App\Services\Contracts;

interface MunicipalServiceContract
{
    public function find(string $latitude, string $longitude);
}
