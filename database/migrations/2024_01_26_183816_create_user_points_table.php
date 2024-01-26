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
        Schema::create('user_points', function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->unsignedBigInteger('municipal_id');
            $table->foreign('municipal_id')->references('id')->on('municipal_geometry');
            $table->geometry('geom');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE user_points ALTER COLUMN geom TYPE geometry(Geometry, 4326) USING ST_SetSRID(geom::geometry, 4326)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_points', function (Blueprint $table) {
            $table->dropForeign(['municipal_id']);
        });

        Schema::dropIfExists('user_points');
    }
};
