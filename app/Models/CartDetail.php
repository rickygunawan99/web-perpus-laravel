<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartDetail
 *
 * @property int $cart_id
 * @property int $member_id
 * @method static \Database\Factories\CartDetailFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartDetail whereMemberId($value)
 * @mixin \Eloquent
 */
class CartDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
}
