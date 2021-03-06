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
            <form method="post" action="{{url()->current()}}/universityProfile" autocomplete="off">
                {{ csrf_field()}}
                <div class="form-row" style="margin-left: -5%;margin-top: 10%">

                    <div align="left">
                        <p align="left" style="font-size: 25px">
                            Which University ?
                        </p>

                        <input type="text" class="form-control form-control-lg "
                               placeholder="University Name"
                               id="university" name="university" required="required"
                               style="background-color: #d0d0d0;width: 150%">


                        <input type="submit" name="submit" class="btn btn-primary" value="Submit"
                               style="margin-top: -17.3%;margin-left: 151%;height: 8%;width: 50%"/>

                    </div>

                </div>
            </form>
        </div>


    </header>
</div>


</body>


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
    var countries = ["Australian National University","Boston University","Brown University","California Institute of Technology (Caltech)",
        "Carnegie Mellon University","Chinese University of Hong Kong (CUHK)","City University of Hong Kong","Columbia University","Cornell University",
        "Delft University of Technology","Duke University","Durham University","Ecole Polytechnique","Eindhoven University of Technology",
        "EPFL - Ecole Polytechnique Federale de Lausanne","ETH Zurich - Swiss Federal Institute of Technology","Fudan University","Georgia Institute of Technology",
        "Harvard University","Hong Kong University of Science and Technology","Imperial College London","Johns Hopkins University",
        "KAIST - Korea Advanced Institute of Science & Technology","King's College London","Korea University","KU Leuven","Kyoto University",
        "Lomonosov Moscow State University","London School of Economics and Political Science (LSE)","Ludwig-Maximilians-Universität München","Lund University",
        "Massachusetts Institute of Technology (MIT)","McGill University","Monash University","Nanyang Technological University, Singapore (NTU)","National Taiwan University (NTU)",
        "National University of Singapore (NUS)","New York University (NYU)","Northwestern University","Ohio State University","Osaka University",
        "Peking University","Pennsylvania State University","Pohang University of Science and Technology (POSTE...","Princeton University",
        "Purdue University","Rice University","Ruprecht-Karls-Universitat Heidelberg","Seoul National University","Shanghai Jiao Tong University",
        "Sorbonne University","Stanford University","Sungkyunkwan University (SKKU)","Technical University of Munich","Tohoku Univeristy",
        "Tokyo Institute of Technology","Tsinghua University","UCL (University College London)","Universidad de Buenos Aires (UBA)","Universite PSL",
        "Universiti Malaya (UM)","University of Amsterdam","University of Auckland","University of Birmingham","University of Bristol","University of British Columbia",
        "University of California, Berkeley (UCB)","University of California, Los Angeles (UCLA)","University of California, San Diego (UCSD)",
        "University of Cambridge","University of Chicago","University of Copenhagen","University of Edinburgh","University of Glasgow",
        "University of Hong Kong","University of Illinois at Urbana-Champaign","University of Leeds","University of Manchester",
        "University of Melbourne","University of Michigan","University of New South Wales (UNSW Sydney)","University of North Carolina, Chapel Hill",
        "University of Nottingham","University of Oxford","University of Pennsylvania","University of Queensland",
        "University of Science and Technology of China","University of Sheffield","University of Southampton","University of St Andrews",
        "University of Sydney","University of Texas at Austin","University of Tokyo","University of Toronto","University of Warwick",
        "University of Washington","University of Western Australia","University of Wisconsin-Madison","University of Zurich","Yale University",
        "Zhejiang University"];

    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("university"), countries);
</script>


</html>