@extends('layouts.app')

@section('content')

   <!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <article>     
                <header class="mb-4">
                    <!-- Post title-->
                    <h3 class="fw-bolder mb-1">Welcome to Blog {{ $post->name }}</h3>
                    <!-- Post meta content-->
            
                    <div class="text-muted fst-italic mb-2">Posted {{ $post->created_at->format('d-m-Y') }}</div>
                    <!-- Post categories-->
                    @foreach ($category as $item)
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{ $item->name }}</a>                       
                    @endforeach
                </header>
                <figure class="mb-4"><img class="img-fluid rounded"  width="900" height="200"  src="{{ asset('images/post/'.$post->image) }}" alt="Image" /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4">{{ $post->description }}</p>
                </section>
            </article>
            <!-- Comments section-->
            <div class=" post-comments">
                <header>
                    <h3 class="h6">Post Comments<span class="no-of-comments">(3)</span></h3>
                </header>  
                @forelse ($post->comments as $comment)
                <div class=" comment-container comment">  
                  
                    <div class="comment-header d-flex justify-content-between">
                        <div class="user d-flex align-items-center">
                            <div class="mb-4">
                                <img src="{{ asset('users/img/user.svg') }}" alt="image" width="30" height="30" class="img-fluid rounded-circle" />                               
                            </div>
                            <div class="mb-8" style="margin-left: 3px">    
                                <div class="mb-8" >
                                    <strong>
                                        @if ($comment->user)
                                            {{ $comment->user->name }}
                                        @endif
                                    </strong>
                                </div>
                                <div class="mb-8" > 
                                    <span class="date"> {{ $comment->created_at->format('d-m-Y')  }}</span>
                                </div>
                            </div>   
                        </div>  
                    </div>  
                    <div class="comment-body">
                        {{ $comment->comment_body }}
                    </div>   
                  
                    @if(Auth::check() && Auth::id() == $comment->user_id)
                    <div> 
                        {{-- <a class ="btn btn-primary btn-sm me-2" href=""> 
                            <i class="fas fa-edit">edit</i>
                        </a> --}}
                        <button  type="button" class =" deletecomment btn btn-danger btn-sm me-2"  value="{{ $comment->id }}" >delete</button>
                    </div>
                    @endif
                </div>  
                @empty
                <div class="mb-4" style="display:flex;" >
                <img src="{{ asset('users/img/user.svg') }}" alt="image" width="30" height="30" class="img-fluid rounded-circle" />                               
                <h6 style="text-align: center">No comment Yet.</h6>
                </div>
                  
                @endforelse      
            </div>     
            @if (Auth::user())
            <div class="add-comment">
                <header>
                    <h3 class="h6">Leave a reply</h3>
                </header>
                @if (Session('message'))
                     <h6 class="alert alert-warning">{{ session('message') }}</h6>
                @endif
                <form action="{{ url('comments') }}" class="commenting-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="post_slug"  value="{{  $post->slug }}" class="form-control" /> 

                        </div>
                        <div class="form-group col-md-12">
                            <textarea class="form-control" name="comment_body" placeholder="Type your comment"></textarea>
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <button type="submit" class="btn btn-secondary">Submit Comment</button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            
        </div>
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <form action="{{ url('search') }}" method ='get'> 
                        <div class="input-group">
                            <input class="form-control" name="search" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                        </div>
                    </form>
                   
                </div>
            </div>
            <!-- Categories widget-->
           
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Category</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ( $all_category as $cateitem)
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="{{ url('categoryindex/'.$cateitem->slug) }}">{{ $cateitem->name  }}</a></li>
                            </ul>
                        </div>   
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
       
        <div>
            <nav>
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
               
                </ul>
            </nav>
        </div>
    </div>
</div> 
@endsection
@section('scrip')
<script>
    $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
     $(document).on('click','.deletecomment',function(){
            //  e.preventDefault();
           if(confirm('You are sure, you want to delete this'))
           {
             var thisClicked = $(this);
             var comment_id = thisClicked.val();

             $.ajax({
                type:"POST",
                url: "/delete-comment",
                data:{
                    'comment_id': comment_id
                },
                Success: function(res){
                    if(res.status == 200){
                        thisClicked.closest('.comment-container').remove();
                        alert(res.message);
                    }
                    alert(res.message);
                }
             });
           }
         });
     });
 
  
 </script>
 
@endsection