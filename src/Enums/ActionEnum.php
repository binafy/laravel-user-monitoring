<?php

namespace Binafy\LaravelUserMonitoring\Enums;

enum ActionEnum:string
{
    case ACTION_STORE = 'store';
    case ACTION_UPDATE = 'update';
    case ACTION_DELETE = 'delete';
    case ACTION_READ = 'read';
    case ACTION_RESTORED = 'restore';
    case ACTION_REPLICATE = 'replicate';
}
