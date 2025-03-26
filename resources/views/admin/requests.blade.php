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
                        <h1> Quotes and Service Requests </h1>
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
                 
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Service and Quote Requests
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Service</th>
                                                    <th>Budget</th>
                                                    <th>Price</th>
                                                    <th>Content</th>
                                                    <th>Mark</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ServiceRequest as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>{{$value->service}}</td>
                                                    <td>{{$value->budget}}</td>
                                                    <td>{{$value->price}}</td>
                                                    <td>{{$value->content}}</td>
                                                    <td class="center"><a onclick="return confirm('Do you want to mark this request?')" href="{{url('/admin')}}/markRequest/{{$value->id}}/{{$value->status}}/service"   class="btn btn-danger"><i class="icon-check icon-white"></i> Mark</a></td>
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Service</th>
                                                    
                                                    <th>Content</th>
                                                    <th>Mark</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Quote as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->name}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>{{$value->service}}</td>
                                                    <td>{{$value->content}}</td>
                                                    <td class="center"><a onclick="return confirm('Do you want to mark this request?')" href="{{url('/admin')}}/markRequest/{{$value->id}}/{{$value->status}}/quote"   class="btn btn-danger"><i class="icon-check icon-white"></i> Mark</a></td>
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END COMMENT AND NOTIFICATION  SECTION -->
                



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection