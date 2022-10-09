<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps=false;
    protected $fillable=[
        'post_title','category_post_id','post_content','post_image','post_status','post_desc'
    ];
    protected $primaryKey='post_id';
    protected $table='tbl_post';
}
