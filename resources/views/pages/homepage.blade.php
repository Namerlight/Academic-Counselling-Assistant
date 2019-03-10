<!DOCTYPE html>
<head>

    <title>Landing Page - Start Bootstrap Theme</title>


    <!side nav custom css>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


</head>
<body>
<div id="wrapper">

    <div id="sidebar-wrapper" style="overflow-x: hidden">
       <img src="/images/profile.jpg" style="border-radius: 50%;height: 100px;width: 100px;margin-top: 40%;margin-left: 25%" > <br>
        <ul class="sidebar-nav" style="margin-top: 90%;margin-left: 10%">
            <li>
                <a href="#">My profile</a>
            </li>
            <li>
                <a href="#">Settings</a>
            </li>


        </ul>
    </div>

    <!navigation>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="height: 9.7%">
        <a href="#menu-toggle" class="btn btn" id="menu-toggle"><font color="white">|||</font></a>

        <ul class="navbar-nav mr-auto" style="margin-left: 0.6%">
            <li>
                <a class="navbar-brand" href="/homepage" style="font-size: 25px;margin-left: 3%">
                    <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -1.9%">
                    <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li>
                <a id="button" class="btn  btn-danger" href="#myModal" data-toggle="modal">Logout</a>
            </li>
        </ul>

    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center">

        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <form>
                <div class="form-row">
                    <div class="col-12 col-md-9 mb-2 mb-md-0">
                        <input type="text" class="form-control form-control-lg">
                    </div>
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>


    </header>
</div>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>
