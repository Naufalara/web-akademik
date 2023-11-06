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
        Schema::create("PKL", function (Blueprint $table) {
            $table->id("nim");
            $table->string("nama");
            $table->string("tahun");
            $table->string("lokasi");
            $table->string("status");
            $table->string("nilai");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
