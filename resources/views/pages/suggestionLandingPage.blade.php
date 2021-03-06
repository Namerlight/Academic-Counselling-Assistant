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

<body background="/images/gradient_5.jpg">

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

                <!--for checking the university subject-->
                    @foreach($universitySubjectFiltered as $filter)
                        @if($uni->name == $filter->university_name)
                            <small style="visibility: hidden;margin-top: -100%">{{$flag =1}}</small>
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

                                <!--for making the unknown value as NULL-->
                                @if($uni->average_fees == '')
                                    <div style="visibility: hidden;height: 0%;width: 0%">
                                        {{$uni->average_fees = "Unknown"}}
                                    </div>
                                @endif


                                <div style="margin-top: -8%;margin-left: 80%">
                                    <a href="{{url()->current()}}/{{$uni->average_fees}}/{{$uni->name}}"
                                       style="text-decoration: none;color: black"><img
                                                src="/images/calculateIcon.png"
                                                height="30%" width="15%">Financial Calculator
                                    </a>
                                </div>


                            </div>
                            <br>

                        @endif
                    @endforeach
                @endforeach

                <! -- if no perfect university found -- >
                @if($flag == 0)
                    <div class="card" style="width: 177%;height: 20%;margin-left: -30%;background-color: whitesmoke">
                        <h3>We can't find anything suitable for you</h3>
                        <h4>Please try with another course or in another country</h4>
                        <div>
                            <a style="color: white" onclick="goBack()" class="btn btn-success">Search With another
                                                                                               subject</a>

                            <a href="/courseMatching/Masters" class="btn btn-success">Search With another country</a>
                        </div>
                    </div>
                @endif

            @else
                <h3>No university found</h3>
            @endif

        </div>


    </header>
</div>


</body>


<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>