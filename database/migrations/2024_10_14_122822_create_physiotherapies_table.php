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
        Schema::create('physiotherapies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id");
            $table->string("patient");
            $table->text("symptoms");
            $table->string("diagnosis");
            $table->string("recover_time");
            $table->text("exercises");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physiotherapies');
    }
};
