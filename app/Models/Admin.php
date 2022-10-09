<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'admin_email','admin_password','admin_name','admin_phone','admin_image'
    ];
    protected $primaryKey='admin_id';
    protected $table='tbl_admin';
    public function role(){
        return $this->belongsToMany('App\Models\Role');
    }
}
