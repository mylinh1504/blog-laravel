<?php

namespace App\Http\Controllers\PageUser;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;

class HomeController extends Controller
{

   public function index()
   {
      $all_category = Category::where('status','0')->get();
      $all_post = Post::where('status','0')->orderBy('created_at','DESC')->paginate(4);
      return view('frontend.index', compact('all_category','all_post'));
   }

   public function getDetailPost($post_slug)
   {
      $all_category = Category::where('status','0')->get();
      $post = Post::where('slug',$post_slug)->where('status','0')->first();
      // dd($post);
      if($post){
         $category = $post->category->all() ;
         return view('frontend.post.detail', compact('post','category','all_category'));
      }
      return redirect('/');


     
   }
   public function viewCategory($slug)
   {
      $all_category = Category::where('status','0')->get();
      $category = Category::where('slug',$slug)->where('status','0')->get();
      if($category)
      {
         foreach($category as $item)
         { 
            $posts=$item->posts()->paginate();
         }
      }
   return view('frontend.category.index',compact('category','posts','all_category'));
   }
   public function viewSearch(Request $request){
      $all_category = Category::where('status','0')->get(); 
      $keyword = $request->search;
      $postSearch = Post::where('name','like','%'.$keyword.'%')
      ->orWhere('description','like','%'. $keyword.'%')->paginate(4);
      $postSearch->appends(['search' => $request->search]);
      return view('frontend.search.search-home', compact('postSearch','all_category','keyword'));
   }

}
