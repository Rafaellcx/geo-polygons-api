<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('state_geometry', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->geometry('geom');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE state_geometry ALTER COLUMN geom TYPE geometry(Geometry, 4326) USING ST_SetSRID(geom::geometry, 4326)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_geometry');
    }
};
