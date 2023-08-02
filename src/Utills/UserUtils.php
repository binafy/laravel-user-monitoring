<?php

namespace Binafy\LaravelUserMonitoring\Utills;

use Illuminate\Database\Schema\Blueprint;

class UserUtils
{
    /**
     * Set up foreign key for the user table based on the configured type.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $table
     * @return void
     */
    public static function userForeignKey(Blueprint $table): void
    {
        $type = config('user-monitoring.user.foreign_key_type', 'id');

        $foreign_key = config('user-monitoring.user.foreign_key');

        $foreignConstraint = $table->nullable()->constrained(config('user-monitoring.user.table'))->nullOnDelete();

        if (!in_array($type, ['ulid', 'uuid'])) {
            $table->foreignId($foreign_key)->{$foreignConstraint};

            return;
        }

        if ($type === 'ulid') {
            $table->foreignUlid($foreign_key)->{$foreignConstraint};

            return;
        }

        $table->foreignUuid($foreign_key)->{$foreignConstraint};
    }
}
