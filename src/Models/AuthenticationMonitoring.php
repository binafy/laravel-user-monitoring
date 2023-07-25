<?php

namespace Binafy\LaravelUserMonitoring\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticationMonitoring extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(config('user-monitoring.user.model'), config('user-monitoring.user.foreign_key'));
    }
}
