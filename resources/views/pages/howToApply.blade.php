<html>
<head>

    <title>ACA</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


    <style>


    </style>

</head>
784BA0

/*
style="background-color: rgba(104,169,163,0.98)"
background-color: #784BA0;
background-image: linear-gradient(225deg, #784BA0 0%, #d151ff 90%, #2B86C5 100%);
*/

<body background="/images/gradient_6.jpg">

<!--for checking session-->
@if (isset(Auth::user()->email))

@else
    <script> window.location = "/index";</script>
@endif


<div id="wrapper">


    <!navigation>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="height: 9.7%">
        <!--  <a href="#menu-toggle" class="btn btn" id="menu-toggle"><font color="white">|||</font></a>  -->
        <ul class="navbar-nav mr-auto" style="margin-left: 0.6%">
            <li>
                <a class="navbar-brand" href="/index" style="font-size: 25px;margin-left: 3%">
                    <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -1.9%">
                    <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li>
                <a id="button" class="btn  btn-danger" href="{{url('/Login/logout')}}" data-toggle="modal">Logout</a>
            </li>
        </ul>

    </nav>


    <!-- Main Content -->
    <header class="masthead text-white text-center">





    </header>
</div>


</body>



</html>