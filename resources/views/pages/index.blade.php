<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ACA</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parallax.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @if (session('user'))
        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal").modal('show');
            });
        </script>
    @endif

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

        .modal-login {
            min-width: 100px;
            background: #3498db;
            border: none;
            line-height: normal;
        }

        .modal-login .modal-login {
            background: #248bd0;
        }

        .modal-login .hint-text a {
            color: #999;
        }

        /*for google button*/

        .loginBtn {
            box-sizing: border-box;
            position: relative;
            /* width: 13em;  - apply for fixed size */
            margin: 0.2em;
            padding: 0 15px 0 46px;
            border: none;
            text-align: left;
            line-height: 34px;
            white-space: nowrap;
            border-radius: 0.2em;
            font-size: 16px;
            color: #FFF;
        }

        .loginBtn:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 0;
            left: 0;
            width: 34px;
            height: 100%;
        }

        .loginBtn:focus {
            outline: none;
        }

        .loginBtn:active {
            box-shadow: inset 0 0 0 32px rgba(0, 0, 0, 0.1);
        }

        /* Google */
        .loginBtn--google {
            /*font-family: "Roboto", Roboto, arial, sans-serif;*/
            background: #DD4B39;
        }

        .loginBtn--google:before {
            border-right: #BB3F30 1px solid;
            background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
        }

        .loginBtn--google:hover,
        .loginBtn--google:focus {
            background: #E74B37;
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
                    @if ($user = Session::get('user'))

                        <input type="text" name="email" class="form-control" value="{{$user->email}}"
                               required="required" style="visibility: hidden">

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
                    <input type="submit" class="btn btn-primary pull-right" value="Enter">
                </div>

                @else
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

        <a href="{{url('login/google')}}" class="btn loginBtn loginBtn--google" style="margin-left: 20%">
            Login with Google
        </a>

        <div class="modal-footer">
            <label class="checkbox-inline pull-left"><input type="checkbox"> Remember me</label>
            <input type="submit" class="btn btn-primary pull-right" value="Login">

        </div>
        @endif
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
                <strong><font color="white">{{$message}}</font></strong>
            </div>
        @endif

    <!--after registering-->
        @if (($message = Session::get('verificationResponse')))
            <div class="alert alert-success"
                 style="width: 30%;margin-left: 35%;margin-top: -3%;border-color: #497652;background-color:#3cff5f ">
                <strong><font color="white">{!! nl2br(e($message)) !!}</font></strong>
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


</body>
</html>