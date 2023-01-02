<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin
 *
 * @property int $id_admin
 * @property string $nip
 * @property string|null $name
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AdminFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIdAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;
}
