<!DOCTYPE html>
<html>
<head>
    <title>ACA</title>

    <!for fb logo>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">



</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

    <ul class="navbar-nav mr-auto" style="margin-left: 0.6%">
        <li>
            <a class="navbar-brand" href="/index" style="font-size: 25px;margin-left: 3%">
                <img src="/images/logo.png" height="90%" width="10%" style="margin-top: -2%">
                <font face="Arcitectura" style="letter-spacing: 10px; font-size: larger">ACA</font>
            </a>
        </li>
    </ul>

</nav>

<br><br>
<form id="msform">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Personal Information</li>
        <li>Academic Information</li>
        <li>Competitive Entrance Exams</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">Personal Information</h3>

        <p>

            <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Fill form via facebook</a>
        </p>
        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p>

        <input type="text" name="name" placeholder="Name">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="email" placeholder="Email">

        <input type="password" name="pass" placeholder="Password"/>
        <input type="password" name="cpass" placeholder="Confirm Password"/>
        <input type="button" name="next" class="next action-button" value="Next"/>
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Academic Information</h2>
        <h3 class="fs-subtitle">Please fill the information carefully</h3>

        <input type="text" name="school" placeholder="School Name">
        <input type="text" name="ssc" placeholder="SSC/A level">
        <input type="text" name="college" placeholder="College Name">
        <input type="text" name="college_group" placeholder="College Group">
        <input type="text" name="hsc" placeholder="HSC/O level">
        <input type="text" name="university" placeholder="University Name">
        <input type="text" name="bsSubject" placeholder="Bachelor Subject">
        <input type="text" name="credits" placeholder="Total credits">
        <input type="text" name="cgpa" placeholder="CGPA">
        <textarea type="text" name="others" placeholder="Others!!"></textarea>



        <input type="button" name="previous" class="previous action-button" value="Previous"/>
        <input type="button" name="next" class="next action-button" value="Next"/>
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Competitive Entrance Exam</h2>
        <h3 class="fs-subtitle">All of these are optional</h3>
        <input type="text" name="sat" placeholder="SAT"/>
        <input type="text" name="ielt" placeholder="IELTS"/>
        <input type="text" name="gre" placeholder="GRE"/>
        <input type="text" name="gmat" placeholder="GMAT"/>
        <input type="text" name="toefl" placeholder="TOEFL"/>

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

    $(".submit").click(function () {
        return false;
    });
    //# sourceURL=pen.js
</script>


</body>

</html>