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
        Schema::create("mahasiswa", function (Blueprint $table) {
            $table->id('nim');
            $table->string('nip');
            $table->string("nama");
            $table->string("email")->unique();
            $table->string("no_handphone")->unique();
            $table->string("angkatan");
            $table->integer("semester");
            $table->string("status");
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
