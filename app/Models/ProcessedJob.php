<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property array $payload
 * @property string $job_id
 * @property string $queue
 * @property int $attempts
 * @property CarbonImmutable $processed_at
 */
class ProcessedJob extends Model
{
    use HasFactory;

    protected $table = 'processed_jobs';

    protected static $unguarded = true;

    protected $casts = [
        'payload' => 'json',
        'processed_at' => 'immutable_datetime',
    ];
}
