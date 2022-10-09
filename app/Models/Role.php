<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'role_name'
    ];
    protected $primaryKey='role_id';
    protected $table='tbl_role';
    
    public function admin(){
        return $this->belongsToMany('App\Models\Admin');
    }
}
