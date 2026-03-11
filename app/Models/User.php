<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Divisi; 

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


    
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function uploadedDocuments()
{
    return $this->hasMany(Document::class, 'uploaded_by');
}

public function createdFolders()
{
    return $this->hasMany(Folder::class, 'created_by');
}
}