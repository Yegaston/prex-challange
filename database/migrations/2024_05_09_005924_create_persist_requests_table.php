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
        Schema::create('persist_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->string('path');
            $table->json('request_body')->nullable();
            $table->json('response_body')->nullable();
            $table->string('origin_ip')->nullable();
            $table->integer('status_code');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persist_requests');
    }
};
