<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Param
 *
 * @property int $id
 * @property string $params
 * @property string|null $startDateTime
 * @property string|null $completionTime
 * @property string|null $endDateTime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Log[] $logs
 * @property-read int|null $logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Param newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Param query()
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereCompletionTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereEndDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereStartDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Param whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Param extends Model
{
    use HasFactory;

    protected $fillable = [
        'params',
        'startDateTime',
        'completionTime',
        'endDateTime'
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}
