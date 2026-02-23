<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    /** @use HasFactory<\Database\Factories\AdminUserFactory> */
    use HasFactory;

    protected $table = 'admin_users';

    protected $fillable = [
        'user',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
