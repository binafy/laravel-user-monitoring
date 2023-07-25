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
        Schema::create(config('user-monitoring.authentication_monitoring.table'), function (Blueprint $table) {
            $table->id();

            if (config('user-monitoring.authentication_monitoring.delete_user_record_when_user_delete', true)) {
                $table->foreignId(config('user-monitoring.user.foreign_key'))
                    ->constrained(config('user-monitoring.user.tables'))
                    ->cascadeOnDelete();
            } else {
                $table->foreignId(config('user-monitoring.user.foreign_key'))
                    ->constrained(config('user-monitoring.user.tables'))
                    ->nullOnDelete();
            }

            $table->string('action_type');

            $table->string('browser_name');
            $table->string('platform');
            $table->string('device');
            $table->string('ip');
            $table->text('page');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('user-monitoring.authentication_monitoring.table'));
    }
};
