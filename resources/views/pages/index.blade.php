<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parallax.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#" style="font-size: 25px"><b>ACA</b></a>


    <ul class="navbar-nav ml-auto">
        <li>
            <a href="#" class="btn btn-primary">Search</a>
        </li>
    </ul>

</nav>

<div class="bgimg-1">
    <div class="caption" style="top: 20%">
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
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
            document.getElementById("navbar").style.padding = "30px 10px";
            document.getElementById("logo").style.fontSize = "25px";
        } else {
            document.getElementById("navbar").style.padding = "80px 10px";
            document.getElementById("logo").style.fontSize = "35px";
        }
    }
</script>

</body>
</html>