<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BatchLog
 *
 * @property int $id
 * @property string $result
 * @property string|null $message
 * @property int|null $batchId
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Batch|null $batch
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BatchLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BatchLog extends Model
{
    use HasFactory;

    protected $table = 'batch_logs';

    protected $fillable = [
        'result',
        'message',
        'batchId'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
