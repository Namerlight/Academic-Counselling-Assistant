<html>
<head>

    <title>ACA</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">


    <style>


    </style>

</head>
784BA0

/*
style="background-color: rgba(104,169,163,0.98)"
background-color: #784BA0;
background-image: linear-gradient(225deg, #784BA0 0%, #d151ff 90%, #2B86C5 100%);
*/

<body>

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


    <div style="margin-top: 10%;margin-left: 22%">
        <h1>Application Guidance</h1>
        <hr style="width: 80%; background-color: black;margin-left: -15%">
    </div>

    <!--steps -->

    <div class="steps" style="margin: auto; padding-right: 200px; alignment: left;margin-top: 10%">
        <b>
            <font face="" style="letter-spacing: 2px; font-size: 18px">
                <div class="border">
                    <p style="margin-left: 2%"><br>
                        Applying to an university for your graduate studies is a complicated affair. We've simplified
                        and listed
                        out all the necessary steps for you here:
                    </p>
                    <ul>
                        <li>Select the University you want to apply to.</li>
                        <li>Find out the Requirements for the Institution</li>
                        <ul>
                            <li>Academic Requirements</li>
                            <li>Language Proficiencies</li>
                            <li>Other Requirements (Experience, Credentials, etc)</li>
                        </ul>
                        <li>Ensure your financial ability to study further</li>
                        <li>Find out the Requirements for the Country's Visa (if necessary)</li>
                        <li>Apply to the institution of your choice by the deadline</li>
                        <li>Apply for a Visa (if necessary) with proof of acceptance</li>
                        <li>Make housing arrangements (if necessary)</li>
                        <li>Make timely travel arrangements to settle in before term</li>
                    </ul>
                </div>
                <br>
                <p>
                    1. Selecting the University <br><br>
                    This should be a no-brainer. Selecting where and what you want to study is simply the the first
                    step.
                    You can use the Browse Universities function on this website to look for a suitable university,
                    or use our university suggestions to get help in making that choice. Whatever you choose, make sure
                    you explore their website
                    to find out what requirements they have.
                </p>
                <br>
                <p>
                    2. Noting down Requirements <br><br>
                    Every university has requirements. You need to look through their websites to find out the
                    requirements, which may include a
                    specific GPA in Undergraduate studies, a specific GRE Score, language requirements such as IELTS or
                    TOEFLs or other languages
                    such as Chinese, French, Korean, et cetera for those national universities, as well as other
                    variable
                    requirements such as work experience, specific courses of study undertaken during undergrads, and so
                    on.
                </p>
                <br>
                <p>
                    3. Ensuring your Finances <br><br>
                    Education in the modern world is expensive. It is paramount that you're able to pay the necessary
                    fees for tutition, laboratories,
                    additional equipment, transport, food, living, and so on. If you already have a living place
                    established, you may not need to consider
                    all of these.
                    <br> Fortunately, you can use our Financial Calculator to estimate these costs in advance.
                </p>
                <br>
                <p>
                    4. Making your Application <br><br>
                    After you've made sure you hit all the requirements and have all the paperwork, you can apply to the
                    institution of your choice.
                    Most have a specific deadline, and you should apply well in advance. While the application process
                    varies for each university,
                    they all will have a step by step guideline written down on their websites which you can follow.
                    Alternatively, you can seek out a
                    guidance counsellor in person, who are experienced in guiding students through this process
                    <br> Always be sure to apply to 1-2 universities that you really want to get into, and have at least
                    3-4 others as backup. If you fail to
                    get into your first choice, you may end up having to wait several months before you can apply for a
                    different term
                </p>
                <br>
                <p>
                    5. Apply for Visa <br><br>
                    If you're an international student, you will have to apply for a visa. Usually, a student visa is
                    required to travel to an university abroad.
                    The visa application process, once again, varies from country to country, but you can find out the
                    process for a country by simply googling the
                    country name, followed by "visa application".
                    <br> A physical guidance counsellor or travel agency can also help in arranging a visa.
                </p>
                <br>
                <p>
                    6. Housing Arrangements <br><br>
                    Once you've gotten your visa, you need to find a place to live. If you're already living near
                    campus, you can skip this step. But if you're travelling
                    in from a different city or country, living arranges need to be made as soon as possible, preferably
                    two to three weeks in advance of the start
                    of the term.
                    <br> You can live with family and friends, or get an apartment of your own. Alternatively, many
                    universities offer student accommodation or dormitories.
                    <br> Keep in mind when determining your living arrangements that if you pick a location close to an
                    university, you may face stiff competition from
                    other students applying for housing. If you pick a distant location, your travelling time and
                    exzpenses will increase. If you pick a location far from
                    the city center, you may not have access to all amenities. A location close to city centers will
                    cost a lot more. Balancing all of these is important.
                </p>
                <br>
                <p>
                    Once all of these are done, you are, hopefully, settled in your new environment and waiting for
                    orientation and the start of term. <br><br>
                </p>

                <b>
                    Best of Luck!
                </b>
                <br><br>
                <a href="/index" class="btn btn-outline-dark" style="margin-left: 45%">Homepage</a>
                <br>
                <br>
                <br>


            </font>
        </b>
    </div>
</div>


</body>


</html>