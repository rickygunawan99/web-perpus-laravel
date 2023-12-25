<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $member_id
 * @property int $isCheckout
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\CartFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Query\Builder|Cart onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereIsCheckout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereMemberId($value)
 * @method static \Illuminate\Database\Query\Builder|Cart withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Cart withoutTrashed()
 * @mixin \Eloquent
 * @property int $total_day
 * @property int $is_checkout
 * @property string $is_approve
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read int|null $books_count
 * @property-read \App\Models\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereIsApprove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereTotalDay($value)
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function books():BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'cart_details', 'cart_id', 'book_id');
    }
}
