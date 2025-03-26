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
                        <center><h2> Admin Dashboard </h2></center>
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
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                <div class="row">
                    <div class="col-lg-7">

                        <div class="chat-panel panel panel-success">
                            <div class="panel-heading">
                                <i class="icon-comments"></i>
                                New Reviews
                            
                            </div>

                            <div class="panel-body">
                                <?php $Review = DB::table('reviews')->where('status',0)->get(); ?>
                                <ul class="chat">
                                    @if($Review->isEmpty())
                                         <center><h2>You Have No New Reviews</h2></center>
                                    @else
                                    @foreach($Review as $comment)
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                        <?php $Product = DB::table('product')->where('id',$comment->id)->get() ?>
                                        @foreach($Product as $pro)
                                            <img src="{{url('/')}}/uploads/product/{{$pro->image_one}}" width="100"  alt="User Avatar" class="img-circle" />
                                        @endforeach
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font "> {{$comment->name}}</strong>
                                                <strong class="primary-font "> Product:  @foreach($Product as $ProductName) {{$ProductName->name}}  @endforeach</strong>
                                                <small class="pull-right text-muted label label-success">
                                                   <a style="color:#ffffff;" onclick="return confirm('Approving this Comment Automatically Sends It to the Websites Front-End, Do You Wish to Continue')" href="{{url('/admin/approve')}}/{{$comment->id}}"> <i class="icon-check"></i> Approve </a>
                                                </small>

                                                <small class="pull-right text-muted label label-danger">
                                                   <a style="color:#ffffff;" onclick="return confirm('Are You Sure You Want To Delete This Comment? You Cannot Undo After This Action')" href="{{url('/admin/decline')}}/{{$comment->id}}"> <i class="icon-trash"></i> Delete </a>
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                                {{$comment->content}}
                                            </p>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endif
                                    
                                    
                                    
                                </ul>
                            </div>

                            

                        </div>


                    </div>
                    <div class="col-lg-5">
                         
                       <div class="panel panel-danger">
                            <div class="panel-heading">
                                <i class="icon-bell"></i> Notifications Alerts Panel
                            </div>

                            <div class="panel-body">
                            <?php
                               use App\Notifications;
                               $Notification = DB::table('notifications')->paginate(7); 
                               
                               

                            ?>
                                <div class="list-group">
                                  @foreach($Notification as $notification)
                                  
                                  <?php
                                  $Type = $notification->type;
                                  switch($Type) {
                                   case 'Payment':
                                       $Icon = 'money';
                                       break;
                                    case 'Comment':
                                       $Icon = 'comment';
                                       break;

                                    case 'Message':
                                       $Icon = 'envelope';
                                       break;

                                    case 'Quote':
                                       $Icon = 'ok';
                                       break;
                                   
                                   default:
                                       $Icon= 'bell';
                                       break;
                                  }
                               ?>

                                    <a href="{{url('/admin/notifications')}}" class="list-group-item">
                                        <i class=" icon-{{$Icon}}"></i> {{$notification->type}}
                                        <span class="pull-right text-muted small"><em> <?php  $timestamp = $notification->created_at; echo timeago($timestamp); ?> </em>
                                    </span>
                                    </a>
                                  @endforeach
                                    
                                   
                                </div>

                                <a href="{{url('/admin/notifications')}}" class="btn btn-default btn-block btn-primary">View All Alerts</a>
                            </div>

                        </div>

                    
                    
                    </div>
                </div>

                       <div class="row">
                    <div class="col-lg-12">

                        <div class="chat-panel panel panel-success">
                            <div class="panel-heading">
                                <i class="icon-envelope"></i>
                                Messages
                            
                            </div>

                            <div class="panel-body">
                                <ul class="chat">
                                @if($Message->isEmpty())
                                         <center><h2>You Have No New Message</h2></center>
                                    @else
                                @foreach($Message as $message)
                                    <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                            <img src="{{url('/')}}/admins_theme/assets/img/1.png" alt="User Avatar" class="img-circle" />
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="primary-font "> {{$message->name}}</strong>
                                                <small class="pull-right text-muted label label-success">
                                                   <a style="color:#ffffff;" href="{{url('/admin/read')}}/{{$message->id}}"> <i class="icon-check"></i> Read </a>
                                                </small>

                                                <small class="pull-right text-muted label label-danger">
                                                   <a style="color:#ffffff;" onclick="return confirm('This Process Cannot Be Undone Please Confirm That You Want To Delete This Message')" href="{{url('/admin/deleteMessage')}}/{{$message->id}}"> <i class="icon-trash"></i> Delete </a>
                                                </small>
                                            </div>
                                             <br />
                                            <p>
                                               {{$message->content}}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                                @endif
                                   
                                </ul>
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