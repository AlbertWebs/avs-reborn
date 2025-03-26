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
                        
                        <center><h2> Pricing </h2></center>
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
                

                <!-- Pricing -->
                <div class="col-lg-12">
                    <ul class="pricing-table" >
                     @foreach($Pricing as $value)

                     <?php
                        $budget = $value->budget;
                        switch ($budget) {
                            case 'free':
                                $style = '';
                                break;
                            case 'starter':
                                $style = 'info';
                                break;
                            case 'basic':
                                $style = 'info';
                                break;
                            case 'standard':
                                $style = 'success';
                                break;
                            case 'premium':
                                $style = 'danger';
                                break;

                            
                            default:
                                $style = 'default';
                                break;
                        }
                     ?>
                        <li class="active {{$style}} col-lg-6">
                            <h3>{{$value->service}}</h3>
                            <h5>{{$value->budget}}</h5>
                            
                            <div class="price-body">
                                <div class="price">
                                    {{$value->price}}/=
                                </div>
                            </div>
                            <div class="features">
                                <ul>
                                   {!!html_entity_decode($value->content)!!}
                                    
                                </ul>
                            </div>
                            <div class="footer">
                                <a href="{{url('admin/editPricing')}}/{{$value->id}}" class="btn btn-info btn-rect">Edit</a>

                                <a href="{{url('admin/deletePricing')}}/{{$value->id}}" class="btn btn-danger btn-rect">delete</a>
                            </div>
                        </li>
                       @endforeach

                        

                       

                       
                                
                    </ul>
                    <div class="clearfix"></div>
                    </div>
                    </div>
                    <br /><br />    <br />                                   
                    <div class="row">
                    <div class="col-lg-12">
                       
                    <div class="clearfix"></div>
            </div>


                <!-- Pricing -->
                



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection