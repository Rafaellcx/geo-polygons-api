<?php

namespace App\Jobs;

use App\Actions\Imports\CreateMunicipalPolygonAction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateMunicipalPolygonJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $uf,
        protected string $name,
        protected string $coordinates,
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
        $polygon = str_replace(',',' ', $this->coordinates);
        $polygon = str_replace(',',' ', $polygon);
        $polygon = str_replace(';',',', $polygon);
        $polygon = str_replace(', ',',', $polygon);

        if (str_ends_with($polygon, ',')) {
            // Remove the last comma from the string
            $polygon = substr($polygon, 0, -1);
        }

        CreateMunicipalPolygonAction::handle($this->uf,$this->name,$polygon);
    }
}
