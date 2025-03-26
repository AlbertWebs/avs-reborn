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
                        <h1> Add Track Service </h1>
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
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/add_TraceServices')}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Price</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="price" value="" placeholder="e.g 12500/= " class="form-control" />
                        </div>
                    </div>

                  

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Frequency</label>
                    <div class="col-lg-8">
                        <select name="frequency" data-placeholder="Choose Payment Frequency" class="form-control chzn-select" tabindex="2">
                          
                          
                              <option value="One Time">One Time</option>
                              <option value="Yearly">Yearly</option>
                              <option value="Monthly">Mothly</option>
                              <option value="Fortnight">Fortnight</option>
                              <option value="Daily">Daily</option>
                              
                      

                        </select>
                        </div>
                        </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">title</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="title" value="" placeholder="e.g Domain Registration " class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Invoice</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="invoice" value="" placeholder="e.g 2019-01-01-001" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Service Next Due Date</label>

                        <div class="col-lg-5">
                            <div class="input-group">
                                <input name="due" class="form-control" type="text" data-mask="9999/99/99" />
                                <span class="input-group-addon">9999/99/99</span>
                            </div>
                        </div>
                    </div>

                    

                   

                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">User_id</label>
                    <div class="col-lg-8">
                        <select name="user_id" data-placeholder="Clients Name" class="form-control chzn-select" tabindex="2">
                          
                           <?php $Users = DB::table('users')->get(); ?>
                           @foreach($Users as $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
                           @endforeach

                        </select>
                        </div>
                        </div>

                        
          
                       
                    
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Add Trace Service</button>
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