<html>
<head>

    <title>ACA</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">

    <style>
        /*Autocomplete part*/

        .autocomplete {
            position: relative;
            display: inline-block;

        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            color: black;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: -2%;
            width: 412px;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #bebebe;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

    </style>

</head>

<body background="/images/eduImg.jpg" style="background-size: cover; ">

<!--for checking session-->
@if (isset(Auth::user()->email))

@else
    <script> window.location = "/index";</script>
@endif

<div id="wrapper">

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

    <!-- Masthead -->
    <header class="masthead text-white text-center">

        <div class="col-md-10 col-lg-8 col-xl-6 mx-auto" style="font-family: Arial">
            <form method="post" action="{{url()->current()}}/subject" autocomplete="off">
                {{ csrf_field()}}
                <div class="form-row" style="margin-left: -5%;margin-top: 10%">

                    <div align="left">
                        <p align="left" style="font-size: 25px">
                            Which subject ?
                        </p>

                        <input type="text" class="form-control form-control-lg "
                               placeholder="Subject Name"
                               id="subject" name="subject" required="required" style="background-color: #d0d0d0;width: 150%">


                        <input type="submit" name="submit" class="btn btn-primary" value="Submit"
                               style="margin-top: -17.3%;margin-left: 151%;height: 8%;width: 50%"/>

                    </div>

                </div>
            </form>
        </div>


    </header>
</div>


</body>


<!-- script for course autosuggestion-->
<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function (e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }

        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    /*An array containing subject names*/
    var subject = ["Aerospace Engineering","Atmospheric Chemistry","Civil and Environmental Systems","Electrical Science and Engineering",
        "International Development","Middle Eastern Studies","Statistics and Data Science","African and African American Studies","Classics","English",
        "History and Science","Molecular and Cellular Biology","Romance Languages and Literatures","Visual and Environmental Studies",
        "Artificial Intelligence Graduate Certificate","Stanford Innovation and Entrepreneurship",
        "Biomedical Informatics: Data, Modeling and Analysis","Civil and Environmental Engineering",
        "Electrical Engineering","Financial Risk Analysis and Management Graduate Certificate","Biology and Biological Engineering",
        "Applied and Computational Mathematics","Geobiology","Business, Economics & Management","Political Science","Control and Dynamical Systems",
        "Philosophy","Archaeology and Anthropology","Classics and English","Engineering Science","History (Ancient and Modern)","Law","Modern Languages",
        "Physics","Anglo-Saxon, Norse, and Celtic","Computer Science","History","Medicine",
        "Theology, Religion, and Philosophy of Religion","Accountancy and Business","Engineering","Social Sciences","Premier Scholars Programmes",
        "Computer Science","Electrical Engineering and Information Technology","Materials Science",
        "Mechanical Engineering","Engineering","Art and Archaeology","East Asian Studies","German",
        "Neuroscience","Slavic Languages and Literatures","Aeronautical Engineering","Biological Sciences with Management",
        "Biotechnology with Spanish for Science","Chemistry with Spanish for Science","Electrical and Electronic Engineering",
        "Mathematics","Medical Biosciences","Computational and Applied Mathematics",
        "Biophysical Sciences","Computer Science","Financial Mathematics",
        "Physical Sciences Division","Statistics","Advanced Architectural Research",
        "Child Health","Developmental Psychology and Clinical Practice","European Studies: European Society",
        "Landscape Architecture","Paediatric Dentistry","Public Diplomacy and Global Communication",
        "Space Syntax: Architecture and Cities","Chinese Language","Theatre Studies","Global Studies","Industrial Design",
        "Industrial and Systems Engineering","Applied Mathematics with specialisation in Mathematical Modelling and Data Analytics","Life Sciences",
        "Physics","Africana Studies","Biological Sciences","Fiber Science and Apparel Design",
        "Human Development","Religious Studies","African Studies","Astrophysics","Computer Science and Psychology",
        "Engineering Sciences","History of Science, Medicine, and Public Health",
        "Mathematics and Philosophy","Philosophy","Russian and East European Studies","American Studies","Chemical Physics",
        "Economics-Mathematics","French and Francophone Studies","Linguistics","Regional Studies","Architecture",
        "Aeronautical and Astronautical Engineering","Mathematics and Physics","Economics","Painting","Accounting and Business",
        "Artificial Intelligence","Celtic and Linguistics","Fashion Designing","Geophysics","Architecture: Design","Comparative Literature: Theory","English: Drama",
        "History of Art","Mathematics: Biological Mathematics","Philosophy: Humanistic Philosophy","South Asia Regional Studies",
        "Applied Biomedical Engineering","Environmental Engineering","Information Systems Engineering","Technical Management",
        "Chemistry and Chemical Engineering","Mechanical Engineering","Life Sciences Engineering","Environmental Sciences and Engineering",
        "Economics","Civil Engineering and Infrastructure Studies","Architecture and Urban Design Program",
        "Information Science and Technology","Actuarial Studies","Philosophy/Arts","Psychology","Accounting","Civil Engineering",
        "Electrical and Electronic Engineering","Industrial and Manufacturing Systems Engineering","French Studies","Mechanical Engineering",
        "Romance Studies","Applied Mathematics","Chinese Studies",
        "Electrical Engineering and Computer Sciences/Materials Science and Engineering Joint Major","Geosystems",
        "Lesbian, Gay, Bisexual, and Transgender Studies","New Media","Social and Cultural Factors in Environmental Design",
        "Biological Chemistry","Environmental Chemistry","Geographical Information Systems","Italian","Mental Health Studies","Planetary Science",
        "Urban Studies","Accounting and Finance","Environmental Sciences","Leadership & Management","Pharmacy and Pharmaceutical Sciences",
        "Speech and Hearing","Probability and Statistics","Intelligence Science and Technology","Chemical Biology","Geochemical",
        "Electronic Engineering","Computer Science with Management","Advanced Computing","Electronic Engineering with Management","Urban Informatics",
        "Anthropology","Civil and Environmental Engineering","Epidemiology","International Development Studies","Molecular and Medical Pharmacology",
        "Psychobiology","Chemical Engineering","Computer Engineering","Industrial Engineering and Engineering Management","Data Science and Technology",
        "Computer Science","Entrepreneurship","International Business","Music Entrepreneurship","Religion and Globalization",
        "Accounting Information and Management","Computer Science and Learning Sciences","Health Sciences Integrated Program",
        "Medical Anthropology","Screen Cultures","Activity Database on Education and Research",
        "Economic Development Studies","Integrated Engineering Course, Human Security Engineering Field",
        "Intelligence Science and Technology","Global Frontier in Life Science Program","International Project Management Course",
        "Mechanical Engineering", "Electrical and Computer Engineering","Architecture and Architectural Engineering","Architecture","Industrial Engineering",
        "Naval Architecture and Ocean Engineering","Anthropology and Law","History","Actuarial Science","Econometrics and Mathematical Economics",
        "Economic History and Geography","Engineering (Civil with Business)","Engineering (Materials)","Engineering (Software with Business)",
        "Engineering Structures","Geoscience","Philosophy (Engineering and IT)","Chemical and Biomolecular Engineering",
        "Industrial & System Engineering","Materials Science & Engineering","Nuclear & Quantum Engineering"];

    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("subject"), subject);
</script>


</html>