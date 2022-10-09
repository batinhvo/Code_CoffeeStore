<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Role extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'admin_admin_id','role_role_id'
    ];
    protected $primaryKey='admin_role_id';
    protected $table='tbl_admin_role';
}
