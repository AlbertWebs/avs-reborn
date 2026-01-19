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
        <div class="inner" style="min-height: 700px;">
            <div class="row">
                <div class="col-lg-12">
                    <center><h2> Copyright Statement </h2></center>
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

            <!-- Alerts -->
            <div class="row">
                <div class="col-lg-12">
                    @if(Session::has('message'))
                        <div class="alert alert-success" style="border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 8px rgba(40,167,69,0.2);">
                            <i class="icon-ok"></i> {{ Session::get('message') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Section -->
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" method="post" action="{{url('/admin/edit_copyright')}}">
                        @foreach($Copyright as $value)
                        <div class="col-lg-12">
                            <div class="box">
                                <header>
                                    <div class="icons"><i class="icon-th-large"></i></div>
                                    <h5>Copyright Statement</h5>
                                    <ul class="nav pull-right">
                                        <li>
                                            <div class="btn-group">
                                                <a class="accordion-toggle btn btn-xs minimize-box" data-toggle="collapse"
                                                    href="#div-1">
                                                    <i class="icon-minus"></i>
                                                </a>
                                                <button class="btn btn-danger btn-xs close-box">
                                                    <i class="icon-remove"></i>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                </header>
                                <div id="div-1" class="body collapse in">
                                    <textarea name="content" id="wysihtml5" class="form-control" rows="10">{{$value->content ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                        <br><br>
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success"><i class="icon-check icon-white"></i> Save Changes</button>
                        </div>
                       
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>

        </div>
        <!-- Inner Content Ends Here -->
    </div>
    <!--END PAGE CONTENT -->

    <!-- RIGHT STRIP  SECTION -->
    @include('admin.right')
    <!-- END RIGHT STRIP  SECTION -->
</div>

@endsection
