<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Contracts\Database\Eloquent\Attribute;
use App\Enum\UserRoleEnum;

use App\Models\Group;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'mobile',
    ];


        public function groups()
        {
            return $this->belongsToMany(Group::class, 'user_group');
        }


}
