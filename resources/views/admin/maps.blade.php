@extends('admin.master')

@section('content')
<div id="wrap" >
        

        <!-- HEADER SECTION -->
        @include('admin.top')
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
        @include('admin.left')
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">

<div class="inner">
    <div class="row">
        <div class="col-lg-12">


            <h2> Maps </h2>



        </div>
    </div>

    <hr />

        <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>

                           
<div class="row">
<div class="col-lg-6">
<div class="box">
<header><h5>Basic Maps</h5></header>
<div class="body">
<div id="gmaps-basic" class="google-maps"></div>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="box warning">
<header>
<h5>Map with markers</h5>
</header>
<div class="body">
<div id="gmaps-marker" class="google-maps"></div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6">
<div class="box inverse">
<header>
<h5>Geolocation</h5>
</header>
<div class="body">
<div id="gmaps-geolocation" class="google-maps"></div>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="box primary">
<header>
<h5>Polylines</h5>
</header>
<div class="body">
<div id="gmaps-polylines" class="google-maps"></div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-6">
<div class="box success">
<header>
<h5>Routes</h5>
</header>
<div class="body">
<div id="gmaps-route" class="google-maps"></div>
</div>
</div>
</div>
<div class="col-lg-6">
<div class="box danger">
<header>
<h5>Geocoding</h5>

<div class="toolbar">
<form method="post" id="geocoding_form" class="form-search">
  <div class="input-group">
  <input id="address" name="address" class="form-control input-sm" type="text" placeholder="search .." />
  <span class="input-group-btn">
<button type="submit" class="btn btn-default btn-sm">Search</button>&nbsp;&nbsp;
  </span>
  </div>
</form>
</div>
</header>
<div class="body">

<div id="gmaps-geocoding" class="google-maps"></div>
</div>
</div>
</div>
</div>



</div>




</div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection