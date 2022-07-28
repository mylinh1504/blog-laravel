
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Blog Complete</a>
        <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                @php 
                    $category = App\Models\Category::where('navbar_status','0')->where('status','0')->get();
                @endphp
                @foreach ($category as $cateitem)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('categoryView/'.$cateitem->slug)}}">{{$cateitem->name}}</a>
                </li>
                @endforeach
               
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <form class="d-flex">
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <button class="btn btn-primary" type="button">Search</button>
                </for>
                <li class="nav-item"><a class="nav-link" href="#"> Login </a></li>
                <li class="nav-item"><a class="nav-link" href="#">Register</a></li>

            </ul>
        </div>
    </div>
</nav>

