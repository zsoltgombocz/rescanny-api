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
        Schema::create('maintenance_modes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('display_text')->nullable()->default(null);
            $table->boolean('enabled')->default(false);
            $table->timestamp('from')->nullable()->default(null);
            $table->timestamp('to')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_modes');
    }
};
