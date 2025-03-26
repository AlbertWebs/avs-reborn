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

<div class="inner" style="min-height:700px;">
    <div class="row">
        <div class="col-lg-12">


            
            <center><h2> Gallery Styles </h2></center>



        </div>
    </div>

    <hr />

        <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
    <div class="row">
        <div class="col-lg-12">


             <div class="panel panel-success">
                <div class="panel-heading">
                   Images with their real relative Sizes
                </div>

                <div class="panel-body">
                  
                 <p style="text-align:center">
                       @foreach($Gallery as $value)
                          <a  id="example1" href="{{url('/')}}/uploads/gallery/{{$value->image}}"  title="<a href='{{url('/admin')}}/editGallery/{{$value->id}}'>Edit</a>"><img src="{{url('/')}}/uploads/gallery/{{$value->image}}" alt="" /></a>
                       @endforeach
                        
                </p>
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