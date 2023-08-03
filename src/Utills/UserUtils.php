<?php

namespace Binafy\LaravelUserMonitoring\Utills;

use Illuminate\Database\Schema\Blueprint;

class UserUtils
{
    /**
     * Return user foreign key by ulid, uuid, id.
     *
     * @param  Blueprint $table
     * @return void
     */
    public static function userForeignKey(Blueprint $table)
    {
        $type = config('user-monitoring.user.foreign_key_type', 'id');

        if ($type === 'ulid') {
            $table->foreignUlid(config('user-monitoring.user.foreign_key'))
                ->nullable()
                ->constrained(config('user-monitoring.user.table'))
                ->nullOnDelete();
        } else if ($type === 'uuid') {
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
