<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'posted_by', 'category_id', 'picture', 'status'];


    public function category(){
        return  $this->belongsTo('App\Models\BlogCategory');
    }

    public function user(){
        return  $this->belongsTo('App\Models\User', 'posted_by');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }


}
