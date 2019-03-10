<!DOCTYPE html>
<head>

    <title>Landing Page - Start Bootstrap Theme</title>


    <!side nav custom css>

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/temp.css') }}" rel="stylesheet">



</head>

<body>


<!navigation>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="height: 9.7%">

    <button type="button" id="sidebarCollapse" class="btn btn-info">
        <i class="fas fa-align-left"></i>
    </button>
    <ul class="navbar-nav mr-auto" style="margin-left: 0.6%">
        <li>
            <a class="navbar-brand" href="/index" style="font-size: 25px;margin-left: 3%">
                <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -1.9%">
                <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
            </a>
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



</body>

</html>
