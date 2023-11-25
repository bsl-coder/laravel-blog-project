<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    public function RelationwithUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function RelationwithCategory(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
