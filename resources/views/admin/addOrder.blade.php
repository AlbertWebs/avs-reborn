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
                        
                        <center><h2> Add Order </h2></center>
                        
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

                @if(Session::has('messageError'))
							   <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
				@endif
                 </center>
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/add_Order')}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Order Title</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="title" value="" placeholder="e.g Mutumba Container " class="form-control" />
                        </div>
                    </div>

                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Order Total Cost</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="total" value="" placeholder="e.g 1990 " class="form-control" />
                        </div>
                 </div>

          
                  <div class="form-group">
                    <label class="control-label col-lg-4">User</label>

                    
                        

                    <div class="col-lg-8">
                        <select name="user_id" data-placeholder="Select Name" class="form-control chzn-select" tabindex="2">
                          
                           <?php $User = DB::table('users')->get(); ?>
                           @foreach($User as $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
                           @endforeach

                        </select>
                    </div>
                    </div>


                  <div class="form-group">
                    <label class="control-label col-lg-4">Status</label>

                    
                        

                    <div class="col-lg-8">
                        <select name="status" data-placeholder="Status" class="form-control chzn-select" tabindex="2">
                          
                         
                              <option value="Initiated...">Initiated</option>
                              <option value="Pending...">Pending</option>
                              <option value="Procesed">Procesed</option>
                              <option value="Delivered">Delivered</option>
                              <option value="Canceled">Canceled</option>
                           

                        </select>
                    </div>
                    </div>

                      <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Description </h5>
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
                                    
                                        <textarea name="content" id="wysihtml5" class="form-control" rows="10"></textarea>

                                    
                                </div>
                            </div>
                        </div>

                   
                   
                    <br><br>
                    <div class="col-lg-12 text-center">
                      <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Add Order</button>
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