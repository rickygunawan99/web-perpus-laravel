<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Admin withoutTrashed()
 */
class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $guarded = [
      'id_admin'
    ];
}
