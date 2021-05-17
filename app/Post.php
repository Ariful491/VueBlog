<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'description', 'thumbnail','category_id','user_id','status',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id')->select('id','name','slug','status');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
