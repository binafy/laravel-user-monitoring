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
        Schema::table(config('user-monitoring.visit_monitoring.table'), function (Blueprint $table) {
            $table->string('user_guard')->nullable();
        });

        Schema::table(config('user-monitoring.action_monitoring.table'), function (Blueprint $table) {
            $table->string('user_guard')->nullable();
        });

        Schema::table(config('user-monitoring.authentication_monitoring.table'), function (Blueprint $table) {
            $table->string('user_guard')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(config('user-monitoring.visit_monitoring.table'), function (Blueprint $table) {
            $table->dropColumn('user_guard');
        });

        Schema::table(config('user-monitoring.action_monitoring.table'), function (Blueprint $table) {
            $table->dropColumn('user_guard');
        });

        Schema::table(config('user-monitoring.authentication_monitoring.table'), function (Blueprint $table) {
            $table->dropColumn('user_guard');
        });
    }
};
