@extends('layouts.master')
@section('title','Post')

@section('content') 
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4> View Posts
                <a href="{{ url('admin/add-post') }}" class="btn btn-primary btn-sm float-end">Add Post</a>
            </h4>
        </div>
       <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{  session('message') }}</div>
            @endif

            <table  id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category name</th> 
                        <th>Post name</th>
                        <th>description</th>
                        <th>Image</th>
                        <th>status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $item)
                    <tr>
                        <td style="width:100px">{{ $item->id }}</td> 
                        <td>
                            @foreach ($item->category->all() as $category)
                                {{ $category->name }}
                            @endforeach
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{ asset('images/post/'.$item->image) }}" width="70px" height="70px" alt="img" style="border-radius:5px">
                        </td>  
                        <td style="width:100px">{{ $item->status == '1'?'Hidden':'visible' }}</td>
                        <td style="width: 100px">
                            <a class ="btn btn-primary btn-sm" href="{{ url('admin/edit-post/'.$item->id)}}"> 
                                <i class="fas fa-edit"></i>
                            </a>   
                        </td>  
                        <td>    
                            <a class ="btn btn-danger btn-sm" href="{{ url('admin/delete-post/'.$item->id)}}"> 
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
@section('footer')

