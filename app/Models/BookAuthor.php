<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\BookAuthor
 *
 * @method static \Database\Factories\BookAuthorFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $book_id
 * @property int $author_id
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereId($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|BookAuthor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookAuthor whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|BookAuthor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|BookAuthor withoutTrashed()
 */
class BookAuthor extends Model
{
    use HasFactory;
    use SoftDeletes;
}
