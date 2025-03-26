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
                        
                        <center><h2> Page Settings </h2></center>
                        
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
                 @foreach($Page as $page)
                 <form class="form-horizontal" method="post"  action="{{url('/admin/set_Page')}}/{{$page->page_name}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Name</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" readonly name="name"  value="{{$page->page_name}}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Sidebar</label>

                        <div class="col-lg-8">
                            <select name="sidebar" class="form-control">
                                <option selected="selected" value="{{$page->sidebar}}"><?php if($page->sidebar=='1'){echo "Active";}else{ echo "Inactive";} ?></option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>    

                    <div class="form-group">
                        <label class="control-label col-lg-4">Sidebar Right</label>

                        <div class="col-lg-8">
                            <select name="sidebar_right" class="form-control">
                                <option selected="selected" value="{{$page->sidebar_right}}"><?php if($page->sidebar_right=='1'){echo "Active";}else{ echo "Inactive";} ?></option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>   

                     <div class="form-group">
                        <label class="control-label col-lg-4">Slider</label>

                        <div class="col-lg-8">
                            <select name="slider" class="form-control">
                                <option selected="selected" value="{{$page->slider}}"><?php if($page->slider=='1'){echo "Active";}else{ echo "Inactive";} ?></option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Menu</label>

                        <div class="col-lg-8">
                            <select name="menu" class="form-control">
                                <option selected="selected" value="{{$page->menu}}"><?php if($page->menu=='1'){echo "Active";}else{ echo "Inactive";} ?></option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                        
                   
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save</button>
                    </div>
                    
                    
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                <form>
                @endforeach
</div>

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