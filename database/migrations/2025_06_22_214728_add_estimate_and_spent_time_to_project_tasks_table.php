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
        Schema::table('project_tasks', function (Blueprint $table) {
            $table->string('estimate')->nullable();    // e.g. '2d 4h'
            $table->string('spent_time')->nullable();  // e.g. '1d 2h'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_tasks', function (Blueprint $table) {
            $table->dropColumn('estimate');
            $table->dropColumn('spent_time');
        });
    }
};
