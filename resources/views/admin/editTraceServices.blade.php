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
                        <h1> Edit Track Service </h1>
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
                 

                 <form class="form-horizontal" method="post"  action="{{url('/admin/edit_TraceServices')}}/{{$TraceServices->id}}" enctype="multipart/form-data">
                    
                 <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Price</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="price" value="{{$TraceServices->price}}" placeholder="e.g 12500/= " class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Frequency</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="frequency" value="{{$TraceServices->frequency}}" placeholder="e.g Per Year " class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">title</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="title" value="{{$TraceServices->title}}" placeholder="e.g Domain Registration " class="form-control" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">Invoice</label>

                        <div class="col-lg-8">
                            <input type="text" id="text1" name="invoice" value="{{$TraceServices->invoice}}" placeholder="e.g 2019-01-01-001" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-3">Service Next Due Date</label>

                        <div class="col-lg-5">
                            <div class="input-group">
                                <input name="due" value="{{$TraceServices->due}}" class="form-control" type="text" data-mask="9999/99/99" />
                                <span class="input-group-addon">9999/99/99</span>
                            </div>
                        </div>
                    </div>

                    

                   

                     <div class="form-group">
                        <label for="text1" class="control-label col-lg-4">User_id</label>
                    <div class="col-lg-8">
                        <select name="user_id" data-placeholder="Clients Name" class="form-control chzn-select" tabindex="2">
                           <?php $User = DB::table('users')->where('id',$TraceServices->user_id)->get(); ?>
                           @foreach($User as $user)
                           <option selected="selected" value="{{$TraceServices->user_id}}">{{$user->name}}</option>
                           @endforeach
                           <?php $Users = DB::table('users')->get(); ?>
                           @foreach($Users as $value)
                              <option value="{{$value->id}}">{{$value->name}}</option>
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