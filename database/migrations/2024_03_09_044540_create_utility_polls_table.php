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
        Schema::create('utility_polls', function (Blueprint $table) {
            $table->id();
            $table->string('pole');
            $table->string('line');
            $table->decimal('latitude',10,8);
            $table->decimal('longitude',10,8);
            $table->string('description');
            $table->boolean('status');

            $table->unsignedBigInteger('route_line_id');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();

            $table->foreign('route_line_id')->references('id')->on('route_lines');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_polls');
    }
};
