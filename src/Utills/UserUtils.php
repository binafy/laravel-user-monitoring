<?php

namespace Binafy\LaravelUserMonitoring\Utills;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;

class UserUtils
{
    /**
     * Return user foreign key by ulid, uuid, id.
     */
    public static function userForeignKey(Blueprint $table): void
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

    /**
     * Get the current guard name.
     */
    public static function getCurrentGuardName(): ?string
    {
        $guards = array_keys(config('auth.guards')); // Get all guard names from config

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return null;
    }

    /**
     * Get the user id by guards.
     */
    public static function getUserId(): ?int
    {
        $guards = config('user-monitoring.user.guard', ['web']);

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->id();
            }
        }

        return null;
    }
}
