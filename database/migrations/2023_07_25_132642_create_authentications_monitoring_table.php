<?php

use Binafy\LaravelUserMonitoring\Utills\UserUtils;
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
                if (config('user-monitoring.user.foreign_key_type') === 'ulid') {
                    $table->foreignUlid(config('user-monitoring.user.foreign_key'))
                        ->nullable()
                        ->constrained(config('user-monitoring.user.table'))
                        ->cascadeOnDelete();
                } else if (config('user-monitoring.user.foreign_key_type') === 'uuid') {
                    $table->foreignUuid(config('user-monitoring.user.foreign_key'))
                        ->nullable()
                        ->constrained(config('user-monitoring.user.table'))
                        ->cascadeOnDelete();
                } else {
                    $table->foreignId(config('user-monitoring.user.foreign_key'))
                        ->nullable()
                        ->constrained(config('user-monitoring.user.table'))
                        ->cascadeOnDelete();
                }
            } else {
                UserUtils::userForeignKey($table);
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
