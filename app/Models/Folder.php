<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'name',
        'divisi_id',
        'parent_id',
        'created_by'
    ];

    
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

   
    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

   
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

   
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}