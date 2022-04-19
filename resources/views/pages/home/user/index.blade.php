
@extends('home')
@section('content_home')
<div class="container fix-home">
    <div class="row">
        <div class="col-12 col-lg-3 bgcolor-while fix-menu-home">
            @include('pages.home.user.menu')
        </div>

        <div class="col-12 col-lg-9 bgcolor-while fix-content-home">
            @yield('content_home_user')
        </div>
    </div>
   
</div>
@endsection