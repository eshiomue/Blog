<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['comment', 'user_id', 'blog_id'];

    public function post(){
        return $this->belongsTo('App\Models\Blog', 'blog_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }


}
