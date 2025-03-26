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
                        <h1> Edit Rendered Service </h1>
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
                   
               
                  <!-- Inner Content Here -->
                 
            <div class="inner">
                

              <div class="row">
               <center>
                 @if(Session::has('message'))
							   <div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif

                @if(Session::has('messageError'))
							   <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
				@endif
                 </center>
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/edit_Service_rendered')}}/{{$Service_Rendered->id}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Service Name</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="name" value="{{$Service_Rendered->name}}" placeholder="e.g Graphics Design " class="form-control" />
                        </div>
                    </div>

                    


                   
                   <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Service Rendered</label>
                    <div class="col-lg-8">
                        <select name="cat" data-placeholder="Choose a Service" class="form-control chzn-select" tabindex="2">
                        <option value="{{$Service_Rendered->cat}}">
                        <?php $Servicee = DB::table('services')->where('id',$Service_Rendered->cat)->get(); ?>
                                                    @foreach($Servicee as $servicee){{$servicee->title}} @endforeach
                        </option>
                           <?php $Service = DB::table('services')->get(); ?>
                           @foreach($Service as $value)
                              <option value="{{$value->id}}">{{$value->title}}</option>
                           @endforeach

                        </select>
                        </div>
                        </div>
          

          
                        
                   
                    
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save </button>
                    </div>
                    
                    
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                <form>
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