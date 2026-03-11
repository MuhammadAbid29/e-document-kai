<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisis';

    protected $fillable = [
        'kode_divisi',
        'nama_divisi',
        'deskripsi',
        'status'
    ];

    public function folders()
{
    return $this->hasMany(Folder::class);
}
}
