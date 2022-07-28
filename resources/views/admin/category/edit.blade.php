@extends('layouts.master')
@section('title','Add Category')
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
            <h4 class="">Edit category</h4>
        </div>
        <div class="card-body">  
            <form action="{{ url('admin/upload-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label><h6>Category</h6></label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="name">
                    @error('name')
                        <span style="color:red">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label><h6>Slug</h6></label>
                    <input type="text" class="form-control" name="slug" value="{{ $category->slug }}" placeholder="Slug"></input>
                    @error('slug')
                        <span style="color:red">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label><h6>Description</h6></label>
                    <textarea class="form-control" style="height:100px" name="description"  placeholder="Description">{{ $category->description }}</textarea>
                    @error('description')
                        <span style="color:red">{{ $message }}</span> 
                    @enderror
                </div>
                <div class="mb-3">
                    <label><h6>Image</h6></label>
                    <input type="file" name="image" class="form-control"/>
                    @error('image')
                        <span> style="color:red">{{ $message }}</span> 
                    @enderror
                </div>
                <h6>Status Model</h6>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>Navbar Status</label>
                        <input type="checkbox" name="navbar_status" {{ $category->navbar_status =='1'?'checked':'' }}/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status" {{ $category->navbar_status =='1'?'checked':'' }}/>
                    </div>
                </div>
          
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
