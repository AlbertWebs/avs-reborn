@extends('admin.master')

@section('content')
<div id="wrap">
    <!-- HEADER SECTION -->
    @include('admin.top')
    <!-- END HEADER SECTION -->

    <!-- MENU SECTION -->
    @include('admin.left')
    <!--END MENU SECTION -->

    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner" style="min-height: 700px; padding: 30px;">
            
            <!-- Welcome Header -->
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-12">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); color: white;">
                        <h1 style="margin: 0 0 10px 0; font-weight: 600; font-size: 32px;">Welcome Back, {{Auth::user()->name}}!</h1>
                        <p style="margin: 0; opacity: 0.9; font-size: 16px;">Here's what's happening with your store today.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-12">
                    @include('admin.panel')
                </div>
            </div>

            <!-- Main Content Row -->
            <div class="row" style="margin-bottom: 30px;">
                <!-- Reviews Section -->
                <div class="col-lg-7" style="margin-bottom: 30px;">
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="icon-comments" style="font-size: 24px;"></i>
                                <h3 style="margin: 0; font-weight: 600; font-size: 20px;">New Reviews</h3>
                            </div>
                        </div>
                        <div style="padding: 20px; max-height: 500px; overflow-y: auto;">
                            <?php $Review = DB::table('reviews')->where('status',0)->get(); ?>
                            @if($Review->isEmpty())
                                <div style="text-align: center; padding: 40px; color: #999;">
                                    <i class="icon-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                    <h4 style="color: #666;">No New Reviews</h4>
                                    <p style="color: #999;">You're all caught up!</p>
                                </div>
                            @else
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($Review as $comment)
                                    <li style="padding: 15px; border-bottom: 1px solid #f0f0f0; transition: all 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                        <div style="display: flex; gap: 15px;">
                                            <?php $Product = DB::table('product')->where('id',$comment->id)->get() ?>
                                            @foreach($Product as $pro)
                                                <img src="{{url('/')}}/uploads/product/{{$pro->image_one}}" width="60" height="60" alt="Product" style="border-radius: 8px; object-fit: cover; border: 2px solid #f0f0f0;" />
                                            @endforeach
                                            <div style="flex: 1;">
                                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 8px;">
                                                    <div>
                                                        <strong style="color: #333; font-size: 15px;">{{$comment->name}}</strong>
                                                        <div style="color: #666; font-size: 13px; margin-top: 3px;">
                                                            Product: @foreach($Product as $ProductName) {{$ProductName->name}} @endforeach
                                                        </div>
                                                    </div>
                                                    <div style="display: flex; gap: 8px;">
                                                        <a onclick="return confirm('Approving this Comment Automatically Sends It to the Websites Front-End, Do You Wish to Continue')" 
                                                           href="{{url('/admin/approve')}}/{{$comment->id}}" 
                                                           style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                                           onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                            <i class="icon-check"></i> Approve
                                                        </a>
                                                        <a onclick="return confirm('Are You Sure You Want To Delete This Comment? You Cannot Undo After This Action')" 
                                                           href="{{url('/admin/decline')}}/{{$comment->id}}" 
                                                           style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                                           onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                            <i class="icon-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <p style="margin: 0; color: #666; font-size: 14px; line-height: 1.6;">{{$comment->content}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="col-lg-5" style="margin-bottom: 30px;">
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="icon-bell" style="font-size: 24px;"></i>
                                <h3 style="margin: 0; font-weight: 600; font-size: 20px;">Notifications</h3>
                            </div>
                        </div>
                        <div style="padding: 20px;">
                            <?php
                                use App\Notifications;
                                $Notification = DB::table('notifications')->paginate(7); 
                            ?>
                            <div style="max-height: 500px; overflow-y: auto;">
                                @if($Notification->isEmpty())
                                    <div style="text-align: center; padding: 40px; color: #999;">
                                        <i class="icon-bell-alt" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                        <h4 style="color: #666;">No Notifications</h4>
                                    </div>
                                @else
                                    <div style="list-style: none; padding: 0; margin: 0;">
                                        @foreach($Notification as $notification)
                                        <?php
                                            $Type = $notification->type;
                                            switch($Type) {
                                                case 'Payment':
                                                    $Icon = 'money';
                                                    $Color = 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)';
                                                    break;
                                                case 'Comment':
                                                    $Icon = 'comment';
                                                    $Color = 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)';
                                                    break;
                                                case 'Message':
                                                    $Icon = 'envelope';
                                                    $Color = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                                                    break;
                                                case 'Quote':
                                                    $Icon = 'ok';
                                                    $Color = 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)';
                                                    break;
                                                default:
                                                    $Icon = 'bell';
                                                    $Color = 'linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%)';
                                                    break;
                                            }
                                        ?>
                                        <a href="{{url('/admin/notifications')}}" style="display: flex; align-items: center; padding: 12px; border-radius: 8px; text-decoration: none; color: #333; transition: all 0.3s; margin-bottom: 8px; border: 1px solid #f0f0f0;"
                                           onmouseover="this.style.background='#f8f9fa'; this.style.borderColor='#e0e0e0';" 
                                           onmouseout="this.style.background='white'; this.style.borderColor='#f0f0f0';">
                                            <div style="width: 40px; height: 40px; border-radius: 8px; background: {{$Color}}; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                                <i class="icon-{{$Icon}}" style="color: white; font-size: 18px;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="font-weight: 600; font-size: 14px; color: #333; margin-bottom: 3px;">{{$notification->type}}</div>
                                                <small style="color: #999; font-size: 12px;">
                                                    <?php $timestamp = $notification->created_at; echo timeago($timestamp); ?>
                                                </small>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <a href="{{url('/admin/notifications')}}" style="display: block; text-align: center; margin-top: 15px; padding: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.3s;"
                               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.3)'" 
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <i class="icon-envelope" style="font-size: 24px;"></i>
                                <h3 style="margin: 0; font-weight: 600; font-size: 20px;">Messages</h3>
                            </div>
                        </div>
                        <div style="padding: 20px;">
                            @if($Message->isEmpty())
                                <div style="text-align: center; padding: 40px; color: #999;">
                                    <i class="icon-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                    <h4 style="color: #666;">No New Messages</h4>
                                    <p style="color: #999;">You're all caught up!</p>
                                </div>
                            @else
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($Message as $message)
                                    <li style="padding: 20px; border-bottom: 1px solid #f0f0f0; transition: all 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                        <div style="display: flex; gap: 15px; align-items: start;">
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="icon-user" style="color: white; font-size: 24px;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                                                    <div>
                                                        <strong style="color: #333; font-size: 16px;">{{$message->name}}</strong>
                                                    </div>
                                                    <div style="display: flex; gap: 8px;">
                                                        <a href="{{url('/admin/read')}}/{{$message->id}}" 
                                                           style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                                           onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                            <i class="icon-check"></i> Read
                                                        </a>
                                                        <a onclick="return confirm('This Process Cannot Be Undone Please Confirm That You Want To Delete This Message')" 
                                                           href="{{url('/admin/deleteMessage')}}/{{$message->id}}" 
                                                           style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                                           onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                            <i class="icon-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <p style="margin: 0; color: #666; font-size: 14px; line-height: 1.6;">{{$message->content}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
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
