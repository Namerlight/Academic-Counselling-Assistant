<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACA</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parallax.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!For modal window modification>
    <style type="text/css">

        .modal-login {
            width: 320px;
        }

        .modal-login .modal-content {
            border-radius: 1px;
            border: none;
        }

        .modal-login .modal-header {
            position: relative;
            justify-content: center;
            background: #f2f2f2;
        }

        .modal-login .modal-body {
            padding: 30px;
        }

        .modal-login .modal-footer {
            background: #f2f2f2;
        }

        .modal-login h4 {
            text-align: center;
            font-size: 26px;
        }

        .modal-login label {
            font-weight: normal;
            font-size: 13px;
        }

        .modal-login .form-control, .modal-login .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .modal-login .hint-text {
            text-align: center;
        }

        .modal-login .close {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .modal-login .checkbox-inline {
            margin-top: 12px;
        }

        .modal-login input[type="checkbox"] {
            margin-top: 2px;
        }

        .modal-login .btn {
            min-width: 100px;
            background: #3498db;
            border: none;
            line-height: normal;
        }

        .modal-login .btn:hover, .modal-login .btn:focus {
            background: #248bd0;
        }

        .modal-login .hint-text a {
            color: #999;
        }


    </style>

</head>
<body>

<!--for checking session-->
@if (isset(Auth::user()->email))
    <script>window.location = "/Login/successLogin"</script>
@endif

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

    <ul class="navbar-nav mr-auto" style="margin-left: 1%">
        <li>
            <a class="navbar-brand" href="/index" style="font-size: 25px;margin-left: 3%">
                <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -2%">
                <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
            </a>
        </li>
    </ul>


    <ul class="navbar-nav ml-auto">
        <li>
            <a href="/register" class="btn btn-primary">Sign Up</a>
            <a id="button" class="btn btn-success" href="#myModal" data-toggle="modal">Login</a>
        </li>
    </ul>


</nav>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">


            <!-- for showing validation error (currently of no use) -->
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{url('/Login/checkLogin')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <div class="clearfix">
                            <label>Password</label>
                            <a href="#" class="pull-right text-muted">
                                <small>Forgot?</small>
                            </a>
                        </div>

                        <input type="password" name="password" class="form-control" required="required">
                    </div>
                </div>
                <div class="modal-footer">
                    <label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label>
                    <input type="submit" class="btn btn-primary pull-right" value="Login">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bgimg-1">
    <div class="caption" style="top: 20%">

        <!--for wrong login details-->
        @if ($message = Session::get('error'))
            <div class="alert alert-danger"
                 style="width: 30%;margin-left: 35%;margin-top: -3%;border-color: #761b18;background-color:red ">
                <strong><font color="white" >{{$message}}</font></strong>
            </div>
        @endif

    <!--after registering-->
        @if (($message = Session::get('response')) ||  ($message = Session::get('success')))
            <div class="alert alert-success"
                 style="width: 30%;margin-left: 35%;margin-top: -3%;border-color: #497652;background-color:#3cff5f ">
                <strong><font color="white" >{!! nl2br(e($message)) !!}</font></strong>
            </div>
        @endif

        <h2><b>Academic Counselling Assistant</b></h2>
    </div>
</div>

<div style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
    <h3 style="text-align:center;">Parallax Index</h3>
    <p>Dialogues</p>
</div>

<div class="bgimg-2">
    <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Scroll</span>
    </div>
</div>

<div style="position:relative;">
    <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
        <p>Scroll up and down to really get the feeling of how Parallax Scrolling works.</p>
    </div>
</div>

<div class="bgimg-3">
    <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">SCROLL UP</span>
    </div>
</div>

<div style="position:relative;">
    <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;">
        <p>Scroll up and down to really get the feeling of how Parallax Scrolling works.</p>
    </div>
</div>

<div class="bgimg-1">
    <div class="caption">
        <span class="border">COOL!</span>
    </div>
</div>

<!Navbar shrink animation>
<script>

</script>

</body>
</html>