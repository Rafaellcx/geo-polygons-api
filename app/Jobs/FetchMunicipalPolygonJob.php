<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchMunicipalPolygonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $uf,
        protected array $municipals,
    )
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->municipals as $key => $value) {
            $coordinatesArray = $value['geometry']['coordinates'][0];
            $coordinatesString = '';

            foreach ($coordinatesArray as $coordinates) {
                $coordinatesString .= implode('# ', $coordinates) . '; ';
            }

            $coordinates = str_replace('#',' ', $coordinatesString);

            CreateMunicipalPolygonJob::dispatch($this->uf,$value['properties']['name'],$coordinates);
        }
    }
}
