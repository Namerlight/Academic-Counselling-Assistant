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

    <div class="jumbotron" style="width: 130%;margin-left: -15%">
        <h4><u>Financial Calculator</u></h4>
        <big><b><u>{{$name}}</u></b></big><br><br>
        <div><b>
                <p align="left">University Average Fees : <span style="float: right">{{$average_fees}}</span></p>
                <br><br>

                <p align="left">Average Living Cost in {{$country}} : <span
                            style="float: right">$ {{$countryObject->average_annual_living_cost}}</span>
                </p>

                <hr style="background-color: #00000a">


                <p align="left">Total Cost(Approx) : <span style="float: right">$ {{$totalCost}}</span></p>
                <br><br>


            </b></div>

        <button onclick="goBack()"
                class="btn btn-success">Go Back
        </button>

        <p>**Costing may differ from the real world time to time </p>
    </div>

</form>


<!-- for going to previous page -->

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>

</html>