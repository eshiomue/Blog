<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];


    public function blogs(){
        return $this->hasMany('App\Models\Blog', 'category_id');
    }
}
