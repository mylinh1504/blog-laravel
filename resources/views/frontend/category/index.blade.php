@extends('layouts.app')

@section('content')

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                 
                    <h3>Category: 
                    @foreach ($category as $item)
                             {{ $item->name }}
                    @endforeach 
                    </h3>
                    <hr>
                    <div class="row">   
                    @foreach ($posts as $item)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="#!">
                                    <img class="card-img-top" width="253" height="200" src="{{asset('images/post/'.$item->image) }}" alt="..." /></a>
                                <div class="card-body">
                                    <div class="small text-muted">{{ $item->created_at->format('d-m-Y')  }}</div>
                                    <h2 class="card-title h4">{{ $item->name }}</h2>
                                    <p class="card-text">{{ $item->description }}</p>
                                    <a class="btn btn-primary" href="{{ url('postView/'.$item->slug) }}">Read more →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                 
                    </div>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                         {{ $posts->links() }}
                        </ul>
                    </nav>
                </div>
                <!-- Side widgets-->
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
                                @foreach ( $all_category as $cateitem)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{ url('categoryindex/'.$cateitem->slug) }}">{{ $cateitem->name }}</a></li>
                                    </ul>
                                </div>   
                                @endforeach
                
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                </div>
            </div>
        </div>
        <!-- Footer-->
      
 
@endsection
