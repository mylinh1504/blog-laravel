<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.inc.admin-head')
</head>

<body>

    @include('layouts.inc.admin-navbar')
    
    <div id="layoutSidenav">
        @include('layouts.inc.admin-sidebar')
        <div id="layoutSidenav_content"> 
            <main> 
                @yield('content')      
            </main>
        </div>
    
    </div>
    @include('layouts.inc.admin-footer')
 
</body>
</html>