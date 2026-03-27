<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'user_id', 'blog_id'];

    public function post(){
        return $this->belongsTo('App\Models\Blog');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


}
