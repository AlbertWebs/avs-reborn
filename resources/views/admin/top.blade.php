<div id="top">

            <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
                <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                    <i class="icon-align-justify"></i>
                </a>
                <!-- LOGO SECTION -->
                <header class="navbar-header">

                    <a href="{{url('/admin')}}" class="navbar-brand">

                        <img src="#" alt="{{ config('app.name', 'Laravel') }}" />
                            
                    </a>
                    
                </header>
                <!-- END LOGO SECTION -->
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a title="Preview Website" target="new" href="{{url('/')}}">
                            <span class="label label-danger"></span>    <i class="icon-globe"></i>&nbsp; 
                        </a>
                    </li>
                    <!-- MESSAGES SECTION -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="label label-danger"><?php $Messages = DB::table('messages')->where('status',0)->get(); $Count = count($Messages); echo $Count ?></span>    <i class="icon-envelope-alt"></i>&nbsp; <i class="icon-chevron-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-messages">
                        @foreach($Messages as $Message)
                            <li>
                                <a href="{{url('admin/read')}}/{{$Message->id}}">
                                    <div>
                                       <strong>{{$Message->name}}</strong>
                                        <span class="pull-right text-muted">
                                            <em>Today</em>
                                        </span>
                                    </div>
                                    <div>{{$Message->content}}
                                        <br />
                                        <span class="label label-primary">Important</span> 

                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                        @endforeach
                           
                            <li>
                                <a class="text-center" href="{{url('/admin/allMessages')}}">
                                    <strong>Read All Messages</strong>
                                    <i class="icon-angle-right"></i>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <!--END MESSAGES SECTION -->

       

                    

                    <!--ADMIN SETTINGS SECTIONS -->

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user "></i>&nbsp; <i class="icon-chevron-down "></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="{{url('/admin/editAdmin')}}/{{Auth::user()->id}}"><i class="icon-user-md"></i> User Profile </a>
                            </li>
                            <li><a href="{{url('/admin/sitesettings')}}"><i class="icon-gear"></i> Settings </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{url('/admin/logout')}}"><i class="icon-signout"></i> Logout </a>
                            </li>
                        </ul>

                    </li>
                    <!--END ADMIN SETTINGS -->
                </ul>

            </nav>

        </div>