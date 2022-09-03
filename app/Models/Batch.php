<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Batch
 *
 * @property int $id
 * @property string|null $id_batch
 * @property int|null $progress
 * @property int|null $jobs
 * @property int|null $successed
 * @property int|null $failed
 * @property int $status
 * @property int $canceled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BatchLog[] $logs
 * @property-read int|null $logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereFailed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereIdBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereJobs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereProgress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereSuccessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Batch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Batch extends Model
{
    use HasFactory;

    protected $table = 'batches';

    protected $fillable = [
        'progress',
        'id_batch',
        'jobs',
        'successed',
        'failed',
        'status',
        'canceled'
    ];

    public function logs()
    {
        return $this->hasMany(BatchLog::class, 'batchId');
    }
}
