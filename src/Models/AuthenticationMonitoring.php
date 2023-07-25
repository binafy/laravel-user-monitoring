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
}
