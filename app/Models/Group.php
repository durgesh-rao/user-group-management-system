<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Group extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_group');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($group) {
            if ($group->users()->exists()) {
                return false;
            }
        });
    }
}
