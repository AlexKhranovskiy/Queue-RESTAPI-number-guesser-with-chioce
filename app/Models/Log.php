<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Log
 *
 * @property int $id
 * @property int $transaction
 * @property int $guessNumber
 * @property int $randNumber
 * @property string $status
 * @property int|null $param_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Param|null $param
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereGuessNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereParamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereRandNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction',
        'guessNumber',
        'randNumber',
        'status',
        'param_id'
    ];

    public function param()
    {
        return $this->belongsTo(Param::class);
    }
}
