<!DOCTYPE html>
<html>
<head>
    <title>ACA</title>

    <!for fb logo>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">


</head>

<!-- for suggesting universities  using AI -->

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
            <h3>Suggestion Shortlist</h3>
            <hr style="background-color: #00000a">
            <div>
                <b>
                    @if($university>0)

                        @foreach($university as $uni)

                                <h5><a href="/{{$uni}}" class="btn btn-outline-dark"><b>{{$uni}}</b></a></h5>

                        @endforeach

                        <div>
                            <br><br>
                            <a href="/index" class="btn btn-success">Go back</a>

                        </div>
                    @else
                        <h4>We can't find any suitable suggestion for you</h4>
                    @endif

                </b>
            </div>
        </div>

    @endif
</form>


</body>

</html>