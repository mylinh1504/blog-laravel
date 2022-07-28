<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.users.index', compact('user'));
    }

    public function edit($id){
        $user = User::find($id);
        return View('admin.users.edit',compact('user'));

    }
    public function upload(Request $request, $id)
    {
        // dd($request->input());
    
        $user = User::find($id);
        if($user)
        {
              $user->role_as = $request->role_as;
              $user->update();  
              return redirect('admin/users')->with('message','User upload Successfully');
        }
        return redirect('admin/users')->with('message','User upload Not failed.');
    }

    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect('admin/users')->with('message','User delete Successfully');
         }
         return redirect('post')->with('message','User delete error');

    }
    
}
