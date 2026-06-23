@extends('admin.master')

@section('content')
<div id="wrap" >
        @include('admin.top')
        @include('admin.left')

        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <center><h2>Add Car Model</h2></center>
                        <p class="text-center text-muted" style="margin-top: 8px;">
                            Car models are used under <strong>Android Radios by Car Model</strong> when assigning products.
                        </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')
                    </div>
                </div>
                <hr />

            <div class="inner">
              <div class="row">
               <center>
                 @if(Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                 @endif
                 @if(Session::has('messageError'))
                    <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
                 @endif
               </center>

                 <form class="form-horizontal" method="post" action="{{url('/admin/add_SubCategory')}}">
                    <div class="form-group">
                        <label for="car-model-name" class="control-label col-lg-4">Car Model Name</label>
                        <div class="col-lg-8">
                            <input type="text" id="car-model-name" name="name" value="{{ old('name') }}" placeholder="e.g. Toyota, Nissan, Honda, Isuzu" class="form-control" required autofocus />
                            <small class="help-block">Use the car brand or model line customers search for.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-4">Parent Category</label>
                        <div class="col-lg-8">
                            <select name="cat_id" class="form-control chzn-select" required>
                                <option value="">-- Select Parent Category --</option>
                                @php $TheCategoryList = DB::table('category')->orderBy('cat')->get(); @endphp
                                @foreach($TheCategoryList as $value)
                                    @php
                                        $isSelected = (string) old('cat_id', $androidCategoryId ?? '') === (string) $value->id;
                                    @endphp
                                    <option value="{{ $value->id }}" {{ $isSelected ? 'selected' : '' }}>{{ $value->cat }}</option>
                                @endforeach
                            </select>
                            @if(!empty($androidCategory))
                                <small class="help-block">Default: <strong>{{ $androidCategory->cat }}</strong></small>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 text-center" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-plus icon-white"></i> Add Car Model
                        </button>
                        <a href="{{ url('/admin/subCategories') }}" class="btn btn-default" style="margin-left: 8px;">View All Car Models</a>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              </div>
            </div>
            </div>
        </div>

        @include('admin.right')
    </div>
@endsection
