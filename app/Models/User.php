<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Divisi; // TAMBAHKAN INI

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'nip',
    'name',
    'email',
    'password',
    'role',
    'divisi_id',
    'photo'
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // TAMBAHKAN INI DI SINI
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

}