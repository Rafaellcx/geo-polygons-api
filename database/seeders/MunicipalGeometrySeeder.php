<?php

namespace Database\Seeders;

use App\Jobs\FetchMunicipalPolygonJob;
use App\Models\MunicipalGeometry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MunicipalGeometrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $filePaths = ['geo_files/geojs-35-mun.json', 'geo_files/geojs-31-mun.json'];

        if (!$this->filePathsExist($filePaths)) {
            return null;
        }

        $municipal = new MunicipalGeometry();

        // Deletes all records if they exist to make a new import.
        $this->truncateMunicipalTable($municipal);

        $file1 = json_decode(Storage::get('geo_files/geojs-35-mun.json'), true);
        $file2 = json_decode(Storage::get('geo_files/geojs-31-mun.json'), true);

        // Calls the function to dispatch the job for each file.

        $this->dispatchFetchJob('SP', $file1['features'],0);
        $this->dispatchFetchJob('MG', $file2['features'],30);
    }

    /**
     * Checks for the existence of multiple files.
     *
     * @param array $filePaths
     * @return bool
     */
    private function filePathsExist(array $filePaths): bool
    {
        return collect($filePaths)->every(fn ($path) => Storage::exists($path));
    }

    /**
     * Truncates the municipal geometry table.
     *
     * @param MunicipalGeometry $municipal
     */
    private function truncateMunicipalTable(MunicipalGeometry $municipal)
    {
        if ($municipal->query()->exists()) {
            $municipal->query()->delete();
            $municipal->query()->truncate();
        }
    }

    /**
     * Dispatch the FetchMunicipalPolygonJob job.
     *
     * @param string $uf
     * @param array $municipals
     * @param int $delay
     */
    private function dispatchFetchJob(string $uf, array $municipals, int $delay=0)
    {
        FetchMunicipalPolygonJob::dispatch(uf: $uf, municipals: $municipals)->delay(now()->addSeconds($delay));
    }
}
