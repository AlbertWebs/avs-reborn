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
                        
                        <center> <h2> Site Settings </h2> </center>
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

                 <form class="form-horizontal" method="post"  action="{{url('/admin/savesitesettings')}}" enctype="multipart/form-data">
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
                            <input class="form-control" name="url" value="{{$value->url}}" type="url" placeholder=",g https://www.designekta.com" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Site Primary Email</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->email}}" name="email" type="email" placeholder="e.g info@designekta.com" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Site Secondary Email</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->email_one}}" name="email_one" type="email" placeholder="e.g designekta@gmail.com" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Mobile One</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->mobile}}" name="mobile" type="text" placeholder="e.g +254723014032" >
                              
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Mobile Two</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->mobile_one}}" name="mobile_one" type="text" placeholder="e.g +254723014032" >
                              
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Mobile Three</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->mobile_two}}" name="mobile_two" type="text" placeholder="e.g +254723014032" >
                              
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Tagline</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->tagline}}" name="tagline" type="text" placeholder="e.g Espirit De Cops" >
                              
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pass1" class="control-label col-lg-4">Till Number</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->till}}" name="till" type="text" placeholder="e.g 942527" >
                              
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
                        <label for="pass1" class="control-label col-lg-4">Instagram</label>

                        <div class="col-lg-8">
                            <input class="form-control" value="{{$value->instagram}}" name="instagram" type="url" placeholder="e.g https://www.instagram.com/designekt" >
                              
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
                                    
                                        <textarea name="welcome" id="wysihtml5" class="form-control" rows="10">{{$value->welcome}}</textarea>

                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    
                   
                    
                
             
                    <center>
                    <div class="form-group col-lg-12">
                        <label class="control-label">SiteLogo</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="{{url('/')}}/uploads/logo/{{$value->logo}}" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="logo" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="control-label">Favicon</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="{{url('/')}}/uploads/logo/{{$value->favicon}}" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="favicon" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="control-label">till image</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="{{url('/')}}/uploads/logo/{{$value->till_image}}" alt="" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="till_image" type="file" /></span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    </center>
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save Changes</button>
                    </div>
                    
                    <input type="hidden" name="favicon_cheat" value="{{$value->favicon}}">
                    <input type="hidden" name="logo_cheat" value="{{$value->logo}}">
                    <input type="hidden" name="till_image_cheat" value="{{$value->till_image}}">
                    
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