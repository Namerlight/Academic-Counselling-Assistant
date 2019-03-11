<!DOCTYPE html>
<head>

    <title>Landing Page - Start Bootstrap Theme</title>


    <!side nav custom css>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">

    <!for text divider>

    <style type="text/css">
        .text-divider {
            margin: 2em 0;
            line-height: 0;
            text-align: center;
        }

        .text-divider span {
            background-color: #bebebe;
            padding: 1em;
        }

        .text-divider:before {
            content: " ";
            display: block;
            border-top: 1px solid black;
            border-bottom: 1px solid #f7f7f7;
        }
    </style>


</head>
<body>
<div id="wrapper">

    <div id="sidebar-wrapper" style="overflow-x: hidden">
        <img src="/images/profile.jpg"
             style="border-radius: 50%;height: 100px;width: 100px;margin-top: 40%;margin-left: 25%"> <br>
        <ul class="sidebar-nav" style="margin-top: 90%;margin-left: 10%">
            <li>
                <a href="#">My profile</a>
            </li>
            <li>
                <a href="#">Edit profile</a>
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
                <a id="button" class="btn  btn-danger" href="#" data-toggle="modal">Logout</a>
            </li>
        </ul>

    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center">

        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <form>
                <div class="form-row">

                    <div style="margin-left: 39%;margin-top: -18%">
                        <img src="/images/bulb.jpg" style="border-radius: 50%;height: 100px;width: 100px;">
                    </div>
                    <div>
                        <h1><font color="black">Have your own preference ?</font></h1>
                    </div>


                    <div class="col-12 col-md-9 mb-2 mb-md-0" style="margin-top: 2%">
                        <input type="text" class="form-control form-control-lg">
                    </div>
                    <div class="col-12 col-md-3" style="margin-top: 2%">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
                    </div>

                    <p class="text-divider" style="width: 50%;margin-left: 24%"><span><font color="black">OR</font></span></p>

                    <div style="margin-left: 27%">
                        <h4><font color="black" >&nbsp;Let us do it for you!</font></h4>
                        <button type="submit" class="btn btn-block btn-lg btn-success">Auto Suggestion</button>
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
