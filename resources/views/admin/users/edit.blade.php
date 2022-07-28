@extends('layouts.master')
@section('title','Edit User')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="text-align: center; color:red"> 
       <h5>please double check the data</h5>
    </div>
@endif

<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="">Edit User
              <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm float-end" ">back</a>
            </h4>
        </div>
        <div class="card-body">  
            <div class="mb-3">
                <label><h6>User Name</h6></label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="enter name">
            </div>
        
            <div class="mb-3">
                <label><h6>Email</h6></label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="enter email"></input>
              
            </div>
            <div class="mb-3">
                <label><h6>Create</h6></label>
                <input type="text" class="form-control" name="password" value="{{ $user->created_at->format('d-m-y') }}" placeholder="enter created_at"></input>
            </div>
            <form action="{{ url('admin/upload-user/'.$user->id) }}" method="POST" >
                @csrf
                @method('PUT')
        
                <div class="mb-3">
                    <label><h6>Role</h6></label>
                    <select class="form-control" name="role_as" value="">
                        <option value="1"{{ $user->role_as ==1? 'selected':''}}>Admin</option>
                        <option value="0"{{ $user->role_as ==0? 'selected':''}}>User</option>
                        <option value="2"{{ $user->role_as ==2? 'selected':''}}>Blogger</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Edit user</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
