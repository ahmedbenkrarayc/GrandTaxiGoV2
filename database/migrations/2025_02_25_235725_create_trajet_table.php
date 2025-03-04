<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trajet', function (Blueprint $table) {
            $table->id();
            $table->datetime('startDateTime');
            $table->string('startPlace');
            $table->string('destination')->nullable();
            $table->string('longtitude')->nullable();
            $table->string('latitude')->nullable();
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservation')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajet');
    }
};
