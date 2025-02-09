<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'notification_id',
        'displayed_at',
    ];

    protected function casts(): array
    {
        return [
            'displayed_at' => 'datetime',
        ];
    }
}
