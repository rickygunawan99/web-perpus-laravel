<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Book
 *
 * @property int $id_books
 * @property string $title
 * @property int $total_page
 * @property int $category_id
 * @property int $author_id
 * @property int $publisher_id
 * @property int|null $stock
 * @method static \Database\Factories\BookFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereIdBooks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTotalPage($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id_book';

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
