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


<form id="msform" method="post" action="{{url()->current()}}/studentAcceptance" autocomplete="off">
    {{csrf_field()}}

    <div>
        <h3>How to help us ? </h3>

        <h4>Help us by giving us some information so that we can improve our service</h4>
        <div class="jumbotron">
            <h4>Have you got chance in any of the university ?</h4>
            <input id="university" name="university" type="text" required="required" placeholder="University Name">
            <input type="submit" name="submit" class="btn btn-success" style="color: white;width: 35%" value="Submit"/>
        </div>

    </div>
</form>


</body>

</html>