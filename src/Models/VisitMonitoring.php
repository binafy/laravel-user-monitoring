<?php

namespace Binafy\LaravelUserMonitoring\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitMonitoring extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(config('user-monitoring.user.model'), config('user-monitoring.user.foreign_key'));
    }
}
