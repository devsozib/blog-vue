<?php

namespace App\Models;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
      use HasFactory;
      protected $fillable = ["user_id","category_id","title","content","thumbnail","status"];

      public function category(){
        return $this->belongsTo(Category::class)->select('id','name','slug');
      }

      public function user(){
        return $this->belongsTo(User::class)->select('id','name');
      }
}
