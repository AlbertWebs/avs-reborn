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
                        
                        <center><h2> Subscribers </h2></center>
                        
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
                   <center>
                 @if(Session::has('message'))
							   <div class="alert alert-success">{{ Session::get('message') }}</div>
				@endif
                 </center>
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    All Subscribers
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Email</th>
                                                    <th>Mail</th>
                                                   
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Subscribers as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->created_at}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td class="center"><a onclick="return confirm('Mail {{$value->email}}')" href="{{url('/admin')}}/mailSubscriber/{{$value->email}}"   class="btn btn-info"><i class="icon-envelope icon-white"></i> Mail</a></td>
                                                    <td class="center"><a onclick="return confirm('Delete This Subscriber?')" href="{{url('/admin')}}/deleteSubscriber/{{$value->id}}"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Del</a></td>
                                                  
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
                                            <center>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                Subscribers Mail Controls
                                                </div>
                                                <div class="panel-body">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#uiModal">
                                                    <i class="icon-pencil icon-white"></i> Compose Mail
                                                    </button>

                                                    <a onclick="return confirm('Mail All Subscribers?')" href="{{url('/admin')}}/mailSubscribers/{{$value->email}}"   class="btn btn-success"><i class="icon-envelope icon-white"></i> Mail All Subscribers</a></center>
                                                    
                                                </div>
                                            </div>
                                            </div>    
                                           
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


    <!-- Modal -->
    <?php 
          $Mail = DB::table('mails')->orderByDesc('id')->paginate(1);
          $countmails = count($Mail);
    ?>
    @if($countmails == 0)
    <div class="col-lg-12">
                        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H3">What would you like to tell your subscribers?</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form role="form" method="POST" action="{{url('/admin/updatemail')}}" enctype="multipart/form-data">
                                           <div class="form-group">
                                            <label>Subject</label>
                                            <input name="subject" class="form-control" />
                                            <p class="help-block">e.g newsletter</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            <input name="file" type="file" />
                                        </div>
                                        <div class="form-group">
                                            <label>Text area</label>
                                            <textarea name="content" class="form-control" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                        <input type="hidden" name="file_cheat" value="0">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
    </div>
    @else
    @foreach($Mail as $mail)
    <div class="col-lg-12">
                        <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="H3">What would you like to tell your subscribers?</h4>
                                        </div>
                                        <div class="modal-body">
                                           <form role="form" method="POST" action="{{url('/admin/updatemail')}}" enctype="multipart/form-data">
                                           <div class="form-group">
                                            <label>Subject</label>
                                            <input name="subject" value="{{$mail->subject}}" class="form-control" />
                                            <p class="help-block">e.g newsletter</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            <embed src="{{url('/')}}/uploads/attachment/{{$mail->file}}" allowfullscreen="true" autoplay="false" height="100%" width="100%"  />
                                            <input name="file" type="file" />
                                        </div>
                                        <div class="form-group">
                                            <label>Text area</label>
                                            <textarea name="content" class="form-control" rows="6">{{$mail->content}}</textarea>
                                        </div>
                                        
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="file_cheat" value="{{$mail->file}}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        
                                    </form>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
    </div>
    @endforeach
    @endif
    
    <!-- Modal -->

@endsection