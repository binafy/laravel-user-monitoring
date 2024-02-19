<?php

namespace Binafy\LaravelUserMonitoring\Models;

use Illuminate\Database\Eloquent\Model;

class VisitMonitoring extends Model
{
    /**
     * Set table name.
     *
     * @var string
     */
    protected $table = 'visits_monitoring';

    /**
     * Guarded columns.
     *
     * @var array
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
