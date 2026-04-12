<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable =['title', 'content', 'posted_by', 'category_id', 'picture'];


    public function category(){
        return  $this->belongsTo('App\Models\BlogCategory');
    }

    public function user(){
        return  $this->belongsTo('App\Models\User', 'posted_by');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }


}
