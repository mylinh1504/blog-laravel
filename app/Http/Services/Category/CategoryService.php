<?php
namespace App\Http\Services\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryService{

    public function getParent()
    {
        return Category::where('parent_id',0)->get();
    }
    
    public function getAll(){
            return Category::orderbyDesc('id')->paginate(20); //phân trang
    }

    public function show()
    {
        return Category::select('name', 'id')
        ->where('parent_id',0)
        ->orderbyDesc('id')
        ->get();
    }

   
  
    public function create($request){
            
        try {
             //dd($request->input());
            Category::create([
                    'name'=>(string) $request->input('name'),
                    'parent_id'=>(int) $request->input('parent_id'),
                    'description'=>(string) $request->input('description'),
                    'content'=>(string) $request->input('content'),
                    'active'=>(int) $request->input('active')
                   ]);

               Session::flash('success', 'Update success');
            }catch (\Exception $err) {
                Session::flash('error', $err->getMessage());
                return false;
            }
             return true;
    }

    public function destroy($request){
        $id =$request->input('id');
        
        $category = Category::where('id', $id)->first();
        if($category)
        {
            return Category::where('id', $id)->orWhere('parent_id',$id)->delete();
        }
        
        return false;


    }
    
}