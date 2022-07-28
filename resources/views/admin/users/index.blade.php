@extends('layouts.master')
@section('title','Post')

@section('content') 
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4> View Users</h4>
        </div>
        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{  session('message') }}</div>
            @endif

        <table  class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Role</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                <tr>
                    <td style="width:100px">{{ $item->id }}</td> 
                    <td style="width:150px">{{ $item->name}}</td>  
                    <td >{{ $item->email }}</td>
                    <td style="width:100px">{{ $item->role_as == '1'?'Admin':'User' }}</td>
                    <td style="width: 100px">
                        <a class ="btn btn-primary btn-sm" href="{{ url('admin/edit-user/'.$item->id)}}"> 
                            <i class="fas fa-edit"></i>
                        </a>        
                        <a class ="btn btn-danger btn-sm" href="{{ url('admin/delete-user/'.$item->id)}}" > 
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>  
                 
                </tr>      
                @endforeach
            </tbody>
        </table>

        </div>
    </div>
</div>
@endsection

