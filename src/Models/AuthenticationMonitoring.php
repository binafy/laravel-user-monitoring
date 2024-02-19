<?php

namespace Binafy\LaravelUserMonitoring\Models;

use Illuminate\Database\Eloquent\Model;

class AuthenticationMonitoring extends Model
{
    /**
     * Set table name.
     *
     * @var string
     */
    protected $table = 'authentications_monitoring';

    /**
     * Guarded columns.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    # Relations

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(
            config('user-monitoring.user.model'),
            config('user-monitoring.user.foreign_key')
        );
    }
}
