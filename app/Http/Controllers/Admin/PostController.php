<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Requests\Admin\PostFormRequest;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
 
    public function index() 
    {
      $post = Post::all();
      // $post = Post::orderBy('id', 'desc')->paginate(5);
      return view('admin.post.index', compact('post'));
    }

    public function create() 
    {
      $category = Category::where('status','0')->get();
      return view('admin.post.create', compact('category'));
    }

    public function store(PostFormRequest $request) 
    {
      // dd($request->input());
      $data = $request->validated();
      $post = new Post();
      $post->name= $data['name'];
      $post->slug = Str::slug($data['slug']);
      $post->description = $data['description'];

      if($request->hasfile('image')){
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalName();
        $file->move('images/post/', $filename);
        $post->image = $filename;
     }
        $post->status= $request->status == true ?'1':'0';
      $post-> created_by= Auth::user()->id;
      $post->save();
      // dd($request);
      $post->category()->sync($request->category_id);
      // dd($post->category->all());
      return redirect('admin/post')->with('message','Post add Successfully');
    }

    public function show($post) 
    {
        return view('admin.post.show', ['post' => $post]);
    }

    
    public function edit($id) 
    {
      $category = Category::where('status','0')->get();
      $post = Post::find($id);

      return view('admin.post.edit', compact('post','category'));
    }

    
    public function upload(PostFormRequest $request, $id) 
    {
      $data = $request->validated();

      $post = Post::find($id);
      $post->name= $data['name'];
      $post->slug = Str::slug($data['slug']);
      $post->description = $data['description'];
      if($request->hasfile('image'))
      {
         $deleteimg='images/post/'.$post->image;
         if(File::exists($deleteimg))
         {
            File::delete($deleteimg);
         }
         $file = $request->file('image');
         $filename = time() . '.' . $file->getClientOriginalName();
         $file->move('images/post/', $filename);
         $post->image = $filename;
      }
      $post->status= $request->status == true ?'1':'0';
      // $post-> created_by= Auth::user()->id;
      $post->update();
      
      $post->category()->sync($request->category_id);
      return redirect('admin/post')->with('message','Post upload Successfully');
    }

    public function destroy($id)
    {
      $post = Post::find($id);
      if($post){
         $post->delete();
         return redirect('admin/post')->with('message','post delete Successfully');
      }
      return redirect('post')->with('message','post delete error');
    }
      
}
