<?php

namespace Binafy\LaravelUserMonitoring\Utills;

use Illuminate\Database\Schema\Blueprint;

class UserUtils
{
    public static function userForeignKey(Blueprint $table)
    {
        if (config('user-monitoring.user.foreign_key_type') === 'ulid') {
            $table->foreignUlid(config('user-monitoring.user.foreign_key'))
                ->nullable()
                ->constrained(config('user-monitoring.user.table'))
                ->nullOnDelete();
        } else if (config('user-monitoring.user.foreign_key_type') === 'uuid') {
            $table->foreignUuid(config('user-monitoring.user.foreign_key'))
                ->nullable()
                ->constrained(config('user-monitoring.user.table'))
                ->nullOnDelete();
        } else {
            $table->foreignId(config('user-monitoring.user.foreign_key'))
                ->nullable()
                ->constrained(config('user-monitoring.user.table'))
                ->nullOnDelete();
        }
    }
}
