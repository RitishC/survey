<!DOCTYPE html>
<html>
<head>
    <title>Surveysysteem</title>
<!-- Stylesheet moet nog toegevoegd worden -->
 <!--   <link href="" rel="stylesheet"> -->
</head>

<body>
<div class="container">
    <!-- HOOFD MENU-->
    <div class="row" style="padding-top:10px;">
        <div class="center-align">
            <a class="" href="/home"> Home </a>
            @if(Auth::check())
                <a class="" href="/logout"> Logout </a>
                <a class="" href="#" style="text-transform:none;">{{ Auth::user()->email }}</a>
            @else
                <a class="" href="/login"> Login </a>
                <a class="" href="/register"> Register </a>
            @endif
        </div>
    </div>
    <!-- EINDE HOOFD MENU -->

    <!-- BODY VAN PAGINA -->
    <div class="row">
        <div class="col s12 m10 offset-m1 l8 offset-l2" style="margin-top:10px;">
            @yield('content')
        </div>
    </div>
    <!-- EINDE BODY VAN PAGINA-->
</div>
</body>
<script src="{{ URL::asset('jquery.min.js') }}"></script>

<script src="{{ URL::asset('init.js') }}"></script>

</html>