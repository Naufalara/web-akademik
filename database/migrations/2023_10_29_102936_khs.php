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
        Schema::create("KHS", function (Blueprint $table) {
            $table->id("nim");
            $table->string("nama");
            $table->integer("semester");
            $table->string("mata_kuliah");
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
