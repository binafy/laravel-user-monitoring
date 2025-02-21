<?php

namespace Binafy\LaravelUserMonitoring\Models;

use Binafy\LaravelUserMonitoring\Utills\ActionType;
use Illuminate\Database\Eloquent\Model;

class ActionMonitoring extends Model
{
    /**
     * Set table name.
     *
     * @var string
     */
    protected $table = 'actions_monitoring';

    /**
     * Guarded columns.
     *
     * @var array
     */
    protected $guarded = ['id'];

    # Methods

    /**
     * Get the type color by action type.
     */
    public function getTypeColor(): string
    {
        return match ($this->action_type) {
            ActionType::ACTION_READ => 'blue',
            ActionType::ACTION_STORE => 'green',
            ActionType::ACTION_UPDATE => 'purple',
            ActionType::ACTION_DELETE => 'red',
            ActionType::ACTION_RESTORED => 'yellow',
            ActionType::ACTION_REPLICATE => 'pink',
            default => 'gray',
        };
    }

    # Relations

    /**
     * Relation one-to-many, User model.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(
            config('user-monitoring.user.model'),
            config('user-monitoring.user.foreign_key')
        );
    }
}
