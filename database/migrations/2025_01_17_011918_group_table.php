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
        //
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->timestamps();
        });
        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('job_position_name');
            $table->timestamps();
        });
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('job_type_name');
            $table->timestamps();
        });
        Schema::create('work_affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('work_affiliation_name');
            $table->timestamps();
        });
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->string('tier_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('groups');
        Schema::dropIfExists('job_positions');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('tiers');
        Schema::dropIfExists('work_affiliations');
    }
};
