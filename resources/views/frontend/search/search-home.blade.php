@extends('layouts.app')

@section('content')  

<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <h3>Search Result: {{ $keyword }} 
            <div class="row">   
                @foreach ($postSearch as $post)
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!">
                            <img  class="card-img-top" width="253" height="200" src="{{asset('images/post/'.$post->image) }}" alt="image" />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at->format('d-m-Y')  }}</div>
                            <h2 class="card-title h4">{{ $post->name }}</h2>
                            <p class="card-text">{{ $post->description }}</p>
                            <a class="btn btn-primary" href="{{ url('postView/'.$post->slug) }}">Read more →</a>
                        </div>
                    </div>
                </div>
                 
                @endforeach
                <div class="text-center">
                    <ul class="pagination">  
                        {{ $postSearch->links() }}
                    </ul>
                </div> 
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <form action="{{ url('search') }}" method ='get'> <div class="input-group">
                        <input class="form-control" name="search" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                    </div>
                </form>
                   
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Category</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ( $all_category as $category)
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ url('categoryindex/'.$category->slug) }}">{{ $category->name  }}</a></li>
                            </ul>
                        </div>   
                        @endforeach
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

     
@endsection
    