<!DOCTYPE html>
<html>
<head>
    <title>ACA</title>

    <!for fb logo>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">


</head>

<body>

@if (isset(Auth::user()->email))

@else
    <script> window.location = "/index";</script>
@endif

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

<br><br>


<form id="msform">

    @if ($university == "null" )
        <div class="jumbotron" style="width: 130%;margin-left: -15%">
            <h3>No University Found</h3>
        </div>

    @else

        <div class="jumbotron" style="width: 130%;margin-left: -15%">
            <h3>{{$university->name}}</h3>
            <hr style="background-color: #00000a">
            <div>
                <b>
                    <p align="left">Country : <span style="float: right">{{$university->country}}</span></p>
                    <br>

                    <p align="left">Qs Ranking : <span style="float: right">{{$university->qs_ranking}}</span></p>
                    <br>

                    <p align="left">Research Output : <span
                                style="float: right">{{$university->research_output}}</span>
                    </p>
                    <br>

                    <p align="left">Status : <span style="float: right">{{$university->status}}</span></p>
                    <br>

                    <p align="left">Employability Ranking : <span
                                style="float: right">{{$university->graduate_employability_ranking}}</span></p>
                    <br>

                    <p align="left">Total Student : <span
                                style="float: right">{{$university->total_student}}</span>
                    </p>
                    <br>

                    <p align="left">Average Fees : <span style="float: right">{{$university->average_fees}}</span></p>


                    <hr style="background-color: #00000a">

                        <a class="btn btn-success" href="/index" >Homepage</a>
                        <a class="btn btn-primary" onclick="goBack()" style="color: white">Go Back</a>

                </b>
            </div>
        </div>

    @endif
</form>


</body>

<!--for going to the previous history page-->
<script>
    function goBack() {
        window.history.back();
    }
</script>

</html>