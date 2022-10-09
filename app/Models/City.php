<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'name_thanhpho','type'
    ];
    protected $primaryKey='matp';
    protected $table='tbl_tinhthanhpho';
}
