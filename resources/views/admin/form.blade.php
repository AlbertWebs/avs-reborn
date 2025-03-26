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
                        <h1> Admin Dashboard </h1>
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
                  <div id="div-1" class="accordion-body collapse in body">
            <form class="form-horizontal">

                <div class="form-group">
                    <label for="text1" class="control-label col-lg-4">Normal Input Field</label>

                    <div class="col-lg-8">
                        <input type="text" id="text1" placeholder="Email" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass1" class="control-label col-lg-4">Password Field</label>

                    <div class="col-lg-8">
                        <input class="form-control" type="password" id="pass1"
                               data-original-title="Please use your secure password" data-placement="top"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4">Read only input</label>

                    <div class="col-lg-8">
                        <input type="text" value="read only" readonly="" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-4">Disabled input</label>

                    <div class="col-lg-8">
                        <input type="text" value="disabled" disabled="disabled" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="text2" class="control-label col-lg-4">With Placeholder</label>

                    <div class="col-lg-8">
                        <input type="text" id="text2" placeholder="placeholder text" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="limiter" class="control-label col-lg-4">Input limiter</label>

                    <div class="col-lg-8">
                        <textarea id="limiter" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="text4" class="control-label col-lg-4">Default Textarea</label>

                    <div class="col-lg-8">
                        <textarea id="text4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="autosize" class="control-label col-lg-4">Textarea With Autosize</label>

                    <div class="col-lg-8">
                        <textarea id="autosize" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tags" class="control-label col-lg-4">Tags</label>

                    <div class="col-lg-8">
                        <input name="tags" id="tags" value="foo,bar,baz" class="form-control" />
                    </div>
                </div>
            </form>
        </div>

        <!-- BEGIN DATE PICKER -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons">
                    <i class="icon-calendar"></i>
                </div>
                <h5>Date Picker</h5>

                <div class="toolbar">
                    <ul class="nav pull-right">
                        <li>
                            <a href="#datePickerBlock" data-toggle="collapse" class="accordion-toggle minimize-box">
                                <i class="icon-chevron-up"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="close-box">
                                <i class="icon-remove"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </header>
            <div id="datePickerBlock" class="body collapse in">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="dp1">Field with the format specified via
                            options</label>

                        <div class="col-lg-3">
                            <input type="text" class="form-control" value="02-16-2012" id="dp1" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" for="dp2">Field with the format specified via data
                            tag</label>

                        <div class="col-lg-3">
                            <input type="text" class="form-control" value="02/16/12" data-date-format="mm/dd/yy"
                                   id="dp2" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" >As component</label>

                        <div class="col-lg-3">
                            <div class="input-group input-append date" id="dp3" data-date="12-02-2012"
                                 data-date-format="dd-mm-yyyy">
                                <input class="form-control" type="text" value="12-02-2012" readonly="" />
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" >Start with years viewMode</label>

                        <div class="col-lg-3">
                            <div class="input-group input-append  date" id="dpYears" data-date="12-02-2012"
                                 data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input class="form-control" type="text" value="12-02-2012" readonly="" />
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-4" >Limit the view mode to months</label>

                        <div class="col-lg-3">
                            <div class="input-group input-append  date" id="dpMonths" data-date="102/2012"
                                 data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months">
                                <input class="form-control" type="text" value="12-02-2012" readonly="" />
                                <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="body">
                            <p>Attached to other element then field and using events to work with the date values.</p>

                            <div class="alert alert-error" id="alert" style="display: none;">
                                <strong>Oh snap!</strong>

                                <p></p>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><a href="#" class="btn btn-default" id="dp4" data-date-format="yyyy-mm-dd"
                                           data-date="2012-02-20">Start date</a></th>
                                    <th><a href="#" class="btn btn-default" id="dp5" data-date-format="yyyy-mm-dd"
                                           data-date="2012-02-25">End date</a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td id="startDate">2012-02-20</td>
                                    <td id="endDate">2012-02-25</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END DATE PICKER -->
                  <!-- Inner Content Ends Here -->



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection