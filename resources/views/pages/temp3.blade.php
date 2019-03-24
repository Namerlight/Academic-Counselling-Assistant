@if (($message = Session::get('verificationResponse')))
    <div class="alert alert-success"
         style="width: 30%;margin-left: 35%;margin-top: -3%;border-color: #497652;background-color:#3cff5f ">
        <strong><font color="white" >{!! nl2br(e($message)) !!}</font></strong>
    </div>
@endif

<!--Homepage things-->
<!-- after bulb image src -->

<div>
    <h1><font color="black">Have your own preference ?</font></h1>
</div>


<div class="col-12 col-md-9 mb-2 mb-md-0 autocomplete" style="margin-top: 2%;text-align: left;">
    <font color="black"> <input type="text" class="form-control form-control-lg "
                                placeholder="Program or Country Name"
                                id="filterType"> </font>
</div>
<div class="col-12 col-md-3" style="margin-top: 2%">
    <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
</div>

<p class="text-divider" style="width: 50%;margin-left: 24%"><span><font
                color="black">OR</font></span></p>

<div style="margin-top: -3%;margin-left: 27%">

    <h4><font color="black">Let us do it for you!</font></h4>
    <button type="submit" class="btn btn-block btn-lg btn-success">Auto Suggestion</button>
</div>


<a href="{{url('login/google')}}" class="btn btn-block btn-facebook"> <i class="fab fa-google"></i>&nbsp;&nbsp;&nbsp;Fill
                                                                                                   form
                                                                                                   via
                                                                                                   Google</a>