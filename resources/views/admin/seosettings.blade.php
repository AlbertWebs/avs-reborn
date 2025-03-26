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
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <center><h2> SEO Settings </h2></center>
                        
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                   <!-- CHART & CHAT  SECTION -->
              
                 <!--END CHAT & CHAT SECTION -->
               
                  <!-- Inner Content Here -->
                 
            <div class="inner">
                

              <div class="row">
               <center>
                 @if(Session::has('message'))
							   <div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif
                 </center>

                 <form class="form-horizontal" method="post"  action="{{url('/admin/saveseosettings')}}" enctype="multipart/form-data">
                    @foreach($SiteSettings as $value)
                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Site Name</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="sitename" value="{{$value->sitename}}" placeholder="e.g Designekta Studios" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Site URL</label>

                        <div class="col-lg-8">
                            <input class="form-control" name="url" value="{{$value->url}}" type="text" placeholder=",g https://www.designekta.com" >
                              
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Tagline</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->tagline}}" name="tagline" type="text" placeholder="e.g Espirit De Cops" >
                              
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Intro</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->intro}}" name="intro" type="text" placeholder="e.g Best Website In the world" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Location</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->location}}" name="location" type="text" placeholder="e.g Pricely House, Moi Avenue Opposite MKU Towers" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Address</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->address}}" name="address" type="text" placeholder="e.g P.O Box 0100 100" >
                              
                        </div>
                    </div>

                        <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Facebook Link</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->facebook}}" name="facebook" type="url" placeholder="e.g https://www.facebook.com/designekta" >
                              
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Twitter</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->twitter}}" name="twitter" type="url" placeholder="e.g https://www.twitter.com/designekta" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Linkedin</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->linkedin}}" name="linkedin" type="url" placeholder="e.g https://www.linkedin.com/designekt" >
                              
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Youtube</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->youtube}}" name="youtube" type="url" placeholder="e.g https://www.youtube.com/designekt" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Google</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->google}}" name="google" type="url" placeholder="e.g https://www.googleplus.com/designekt" >
                              
                        </div>
                    </div>


          
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Welcome Note</h5>
                                    <ul class="nav pull-right">
                                        <li>
                                            <div class="btn-group">
                                                <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse"
                                                    href="#div-1">
                                                    <i class="icon-minus"></i>
                                                </a>
                                                 <button class="btn btn-danger btn-xs close-box">
                                                    <i
                                                        class="icon-remove"></i>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </header>
                                <div id="div-1" class="body collapse in">
                                    
                                        <textarea name="welcome" id="" class="form-control" rows="10">{{$value->welcome}}</textarea>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save Changes</button>
                    </div>
                    
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @endforeach
                <form>


            </div>
                  <!-- Inner Content Ends Here -->



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
        @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection