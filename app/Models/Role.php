<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_code',
    ];


    public function permissions(){
        return $this->belongsToMany('App\Models\Permission', 'role_permissions',  'role_id', 'permission_id');
    }
}
