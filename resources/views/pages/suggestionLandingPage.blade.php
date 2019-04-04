<html>
<head>

    <title>ACA</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


    <style>


    </style>

</head>

/*style="background-color: rgba(104,169,163,0.98)"*/

<body background="/images/gradient_2.jpg" style="background-size: cover">

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


        <div class="col-md-10 col-lg-8 " style="font-family: Arial;color: black;margin-top: -5%">


            <div class="card"
                 style="background-color: #bebebe ; color: black; margin-top: -17%;margin-left: 10%;width: 100%">
                <div style="margin-left: 120%">
                    <a type="button" class="btn btn-primary" href="/index">Reset</a>
                </div>
                <h3>Course Matching Tool</h3>
                <p align="left">Current Filters:</p>
                <div style="margin-left: 5%">
                    <input type="button" class="btn btn-primary" value="{{$studyType}}"> &nbsp;
                    <input type="button" class="btn btn-primary" value="{{$country}}"> &nbsp;
                    <input type="button" class="btn btn-primary" value="{{$subject}}"> &nbsp;
                </div>
            </div>

            <br>
            @if(count($university)>0)

                @foreach($university as $uni)
                    <div class="card" style="width: 177%;height: 20%;margin-left: -30%">
                        <p align="center" style="font-size: 20px">
                            <b>{{$uni->name}}</b>
                        </p>
                        <br>
                        <div class="card" style="background-color: #a3a3a3;border-color: black">
                            <p style="color: black">
                                Ranking : {{$uni->qs_ranking}} &nbsp;&nbsp;&nbsp;
                                Status : {{$uni->status}}&nbsp;&nbsp;&nbsp;
                                Total Student : {{$uni->total_student}}&nbsp;&nbsp;&nbsp;
                                Average Fees : {{$uni->average_fees}}&nbsp;&nbsp;&nbsp;
                                Country : {{$uni->country}}
                            </p>
                        </div>


                        <!--need to change when we change the domain name-->
                        @if( url()->current() == "http://aca.dev/countryMatching/country")

                        @else
                            <div style="margin-top: -8%;margin-left: 80%">
                                <a href="{{url()->current()}}/{{$uni->average_fees}}"
                                   style="text-decoration: none;color: black"><img
                                            src="/images/calculateIcon.png"
                                            height="30%" width="15%">Financial Calculator
                                </a>
                            </div>

                        @endif

                    </div>
                    <br>
                @endforeach

            @else
                <h3>No university found</h3>
            @endif

        </div>


    </header>
</div>


</body>


</html>