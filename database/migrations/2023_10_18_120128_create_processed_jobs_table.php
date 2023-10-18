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
        Schema::create('processed_jobs', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->text('payload');
            $table->string('job_id');
            $table->string('queue');
            $table->integer('attempts');
            $table->timestamp('processed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processed_jobs');
    }
};
