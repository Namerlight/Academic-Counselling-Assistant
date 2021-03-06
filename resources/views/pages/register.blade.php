<!DOCTYPE html>
<html>
<head>
    <title>ACA</title>

    <!for fb logo>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">

    <style>
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

@if (isset(Auth::user()->email))
    <script> window.location = "/index";</script>
@else

@endif

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

    <ul class="navbar-nav mr-auto" style="margin-left: 0.6%">
        <li>
            <a class="navbar-brand" href="/index" style="font-size: 25px;margin-left: 3%">
                <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -1.9%">
                <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
            </a>
        </li>
    </ul>

</nav>

<br><br>
<form id="msform" method="post" action="{{'reg'}}">
{{ csrf_field()}}
<!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Personal Information</li>
        <li>Academic Information</li>
        <li>Competitive Entrance Exams</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <!--personal info-->
        @if(count($errors)>0)

            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>

            @endforeach

        @endif

        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">Personal Information</h3>

        <p>

            <a href="{{url('login/google')}}" class="btn loginBtn loginBtn--google" >
                Fill form via Google
            </a>
        </p>
        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p>

        @if ($user = Session::get('user'))
            <input type="text" name="name" placeholder="Name &#x00B**" value="{{$user->name}}">
            <input type="text" name="email" placeholder="Email &#x00B**" value="{{$user->email}}">
        @else
            <input type="text" name="name" placeholder="Name &#x00B**" value="{{old('name')}}">
            <input type="text" name="email" placeholder="Email &#x00B**" value="{{old('email')}}">
        @endif


        <input type="text" name="username" placeholder="username &#x00B**" value="{{old('username')}}">


        <input type="password" name="pass" placeholder="Password"/>
        <input type="password" name="cpass" placeholder="Confirm Password"/>
        <input type="button" name="next" class="next action-button" value="Next" value="{{old('name')}}"/>
    </fieldset>

    <!--academic info-->
    <fieldset>
        <h2 class="fs-title">Academic Information</h2>
        <h3 class="fs-subtitle">Please fill the information carefully</h3>

        <input type="text" name="school" placeholder="School Name" value="{{old('school')}}">
        <input type="text" name="ssc" placeholder="SSC/A level grade" value="{{old('ssc')}}">
        <input type="text" name="college" placeholder="College Name &#x00B**" value="{{old('college')}}">
        <input type="text" name="college_group" placeholder="College Group &#x00B**" value="{{old('college_group')}}">
        <input type="text" name="hsc" placeholder="HSC/O level grade &#x00B**" value="{{old('hsc')}}">
        <input type="text" name="university" placeholder="University Name &#x00B**" value="{{old('university')}}">
        <input type="text" name="bsSubject" placeholder="Bachelor Subject &#x00B**" value="{{old('bsSubject')}}">
        <input type="text" name="credits" placeholder="Total credits &#x00B**" value="{{old('credits')}}">
        <input type="text" name="cgpa" placeholder="CGPA &#x00B**" value="{{old('cgpa')}}">
        <textarea type="text" name="others" placeholder="Others!!" value="{{old('others')}}"></textarea>


        <input type="button" name="previous" class="previous action-button" value="Previous"/>
        <input type="button" name="next" class="next action-button" value="Next"/>
    </fieldset>

    <!--Competitive exam info-->
    <fieldset>
        <h2 class="fs-title">Competitive Entrance Exam</h2>
        <h3 class="fs-subtitle">All of these are optional</h3>
        <input type="text" name="sat" placeholder="SAT" value="{{old('sat')}}"/>
        <input type="text" name="ielts" placeholder="IELTS" value="{{old('ielts')}}"/>
        <input type="text" name="gre" placeholder="GRE" value="{{old('gre')}}"/>
        <input type="text" name="gmat" placeholder="GMAT" value="{{old('gmat')}}"/>
        <input type="text" name="toefl" placeholder="TOEFL" value="{{old('toefl')}}"/>

        <input type="button" name="previous" class="previous action-button" value="Previous"/>
        <input type="submit" name="submit" class="submit action-button" value="Submit"/>


    </fieldset>


</form>

<!scripts for modal changing animation>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<script id="rendered-js">

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                $(document).ready(function () {

                    $(window).scrollTop(0);
                    return false;

                });
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = now * 50 + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });

                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });

    });

    $(".previous").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {

                $(document).ready(function () {
                    $(window).scrollTop(0);
                    return false;

                });


                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = (1 - now) * 50 + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });

    });


    //# sourceURL=pen.js
</script>


</body>

</html>