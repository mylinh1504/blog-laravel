<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'post';
    protected $fillable =[
        'name',
        'category_id',
        'slug',
        'description',
        'status',
        'created_by'
    ];

    public function category(){
        return $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function comments(){
        return $this->hasMany(Comments::class, 'post_id','id');
    }


}
