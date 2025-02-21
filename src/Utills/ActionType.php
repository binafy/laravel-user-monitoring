<?php

namespace Binafy\LaravelUserMonitoring\Utills;

class ActionType
{
    public const ACTION_STORE = 'store';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DELETE = 'delete';
    public const ACTION_READ = 'read';
    public const ACTION_RESTORED = 'restore';
    public const ACTION_REPLICATE = 'replicate';

    public static array $types = [
        self::ACTION_STORE,
        self::ACTION_UPDATE,
        self::ACTION_DELETE,
        self::ACTION_READ,
        self::ACTION_RESTORED,
        self::ACTION_REPLICATE,
    ];
}
