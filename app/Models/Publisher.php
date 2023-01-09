<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Publisher
 *
 * @property int $id_publisher
 * @property string $name
 * @method static \Database\Factories\PublisherFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher query()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereIdPublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereName($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Publisher onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Publisher withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Publisher withoutTrashed()
 */
class Publisher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_publisher';

    public $timestamps = false;

    protected $guarded = [
        'id_publisher'
    ];
}
