<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
   

   public function index()
   {
      $category = Category::all();
     return view('admin.category.index', compact('category'));
   }

   public function create()
   {
     return view('admin.category.create',[
     ]);
   }

   public function store(CategoryFormRequest $request)
   {
      // dd($request->input());
      $data = $request->validated();
      $category = new Category();
      $category->name= $data['name'];
      $category->slug =  Str::slug($data['slug']);
      $category->description = $data['description'];
      
      $category->navbar_status= $request->navbar_status == true ? '1':'0';
      $category->status= $request->status == true ?'1':'0';
      $category->created_by= Auth::user()->id;
      $category->save();
      return redirect('admin/category')->with('message','Category add Successfully');
   }

   public function edit($id)
   {
      $category =Category::find($id);
       return view('admin.category.edit',compact('category'));
      
   }

   public function upload(CategoryFormRequest $request, $id)
   {
      $data = $request->validated();

      $category = Category::find($id);
      $category->name= $data['name'];
      $category->slug = Str::slug($data['slug']);
      $category->description = $data['description'];
     
    
      $category->navbar_status= $request->navbar_status == true ? '1':'0';
      $category->status= $request->status == true ?'1':'0';
      $category->update();
      return redirect('admin/category')->with('message','Category upload Successfully');
   }


   public function destroy(Request $request)
   {
      $category = Category::find($request->category_delete_id);
      if($category){
         $deleted = 'images/category/'.$category->image;
         if(File::exists($deleted)){ 
            File::delete($deleted);
         }
         $category->posts()->delete();
         $category->delete();
         return redirect('admin/category')->with('message','Category delete Successfully');
      }
      return redirect('category')->with('message','Category delete error');

   }
   

}
