<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     *
     */
    protected $fillable = [
        'user_id',
        'description',
        'expiration_date',
        'done',
        'done_date',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(\Modules\Users\Entities\User::class,'user_id', 'id');
    }
}
