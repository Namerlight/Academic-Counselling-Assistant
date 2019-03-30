<html>
<head>

    <title>ACA</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


</head>

<body background="/images/eduImg.jpg" style="background-size: cover; ">

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

    <!-- Masthead -->
    <header class="masthead text-white text-center">

        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto" style="font-family: Arial">
            <form autocomplete="off">
                <div class="form-row" style="margin-left: -5%;margin-top: -10%">

                    <p align="left">
                        <font size="6px">Course Matching Tool</font><br>
                        Find the perfect university program for you. Answer four simple questions and use the matching
                        tool filters to tell us what you want.
                    </p>

                    <div align="left">
                        <p align="left" style="font-size: 25px">
                           Which level study ?
                        </p>
                        <a id="button" class="btn btn-secondary" href="/courseMatching/Masters">Masters</a>

                    </div>

                </div>
            </form>
        </div>


    </header>
</div>


</body>

</html>