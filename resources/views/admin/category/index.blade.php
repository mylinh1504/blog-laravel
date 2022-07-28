@extends('layouts.master')
@section('title','Category')
@section('content')
<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ url('admin/delete-category/') }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Delete category its post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="category_delete_id" id="category_id">
                <p> You are sure, you want to delete this</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4> View Posts
                <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">Add Post</a>
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
                        <th>Description</th>
                        <th>status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td style="width:100px">{{ $item->id }}</td>
                        <td >{{ $item->name }}</td>
                        <td style="max-width: 300px">{{ $item->description }}</td>
                        
            
                        <td style="width:100px">{{ $item->status == '1'?'Hidden':'show' }}</td>
                        <td style="width: 100px">
                            <a class ="btn btn-primary btn-sm" href="{{ url('admin/edit-category/'.$item->id)}}"> 
                                <i class="fas fa-edit"></i>
                            </a>        
                            {{-- <a class ="btn btn-danger btn-sm deleteCategory " href="{{ url('admin/delete-category/'.$item->id)}}"> 
                                <i class="fa fa-trash"></i>
                            </a> --}}
                        </td>
                        <td>
                            <button  type="button" class="btn btn-danger deleteCategory" value="{{ $item->id }}">Delete</button>
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

<script>
   $(document).ready(function(){
    $(document).on('click','.deleteCategory',function(e){
            e.preventDefault();
            var category_id = $(this).val();
            $('#category_id').val(category_id);
            $('#deleteModal').modal('show');
        });
    });

 
</script>

@endsection