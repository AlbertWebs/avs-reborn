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
                        
                        <center><h2> Categories </h2></center>
                        
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
                                    Categories
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    
                                                    <th>Edit</th>
                                                    <th>Del</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Category as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->cat}}</td>
                                                    <td class="center"><a href="{{url('/admin')}}/editCategories/{{$value->id}}"   class="btn btn-info"><i class="icon-pencil icon-white"></i> Edit</a> <br><br><br><br><a href="#"   class="btn btn-success" data-toggle="modal" data-target="#buttonedModal_{{$value->id}}"><i class="icon-link icon-white"></i> Get Link </a></td>
                                                    <td class="center"><a onclick="return confirm('Deleting this May affect Tables that depend on this item, Are you sure you want to continue')" href="{{url('/admin')}}/deleteCategory/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></td>
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

    @foreach($Category as $value)
<!-- Modal links  -->
<div class="col-lg-12">
                        <div class="modal fade" id="buttonedModal_{{$value->id}}" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H1">{{$value->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                        <?php $final = preg_replace('#[ -]+#', '-', $value->cat); ?>
                                            <input style="width:100%" type="url" value="{{url('/')}}/products/{{$value->slung}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
<!-- </Modal Links -->
@endforeach

@endsection