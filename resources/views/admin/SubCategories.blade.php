@extends('admin.master')

@section('content')
<div id="wrap" >
        @include('admin.top')
        @include('admin.left')

        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <center><h2>Car Models</h2></center>
                        @if(!empty($androidCategory))
                            <p class="text-center text-muted">Models for <strong>{{ $androidCategory->cat }}</strong></p>
                        @endif
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')
                    </div>
                </div>
                <hr />

                <center>
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif
                    @if(Session::has('messageError'))
                        <div class="alert alert-danger">{{ Session::get('messageError') }}</div>
                    @endif
                </center>

                <div class="row" style="margin-bottom: 25px;">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="icon-plus"></i> Quick Add Car Model
                            </div>
                            <div class="panel-body">
                                @if(!empty($androidCategoryId))
                                <form class="form-inline" method="post" action="{{ url('/admin/add_SubCategory') }}" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="cat_id" value="{{ $androidCategoryId }}">
                                    <div class="form-group" style="flex: 1; min-width: 220px;">
                                        <input type="text" name="name" class="form-control" placeholder="New car model e.g. Isuzu, Ford, Lexus" required style="width: 100%;">
                                    </div>
                                    <button type="submit" class="btn btn-success">
                                        <i class="icon-plus icon-white"></i> Add Model
                                    </button>
                                    <a href="{{ url('/admin/addSubCategory') }}" class="btn btn-default">Full Form</a>
                                </form>
                                @else
                                <div class="alert alert-warning" style="margin: 0;">
                                    Create the <strong>Android Radios by Car Model</strong> category first, then you can add car models here.
                                    <a href="{{ url('/admin/addCategory') }}">Add category</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                                <span>All Car Models ({{ count($Category) }})</span>
                                <a href="{{ url('/admin/addSubCategory') }}" class="btn btn-success btn-sm">
                                    <i class="icon-plus icon-white"></i> Add Car Model
                                </a>
                            </div>
                            <div class="panel-body">
                                @if(count($Category) === 0)
                                    <p class="text-muted text-center" style="padding: 30px 0;">
                                        No car models yet. Use the form above to add Toyota, Nissan, Honda, and more.
                                    </p>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Car Model</th>
                                                <th>URL Slug</th>
                                                <th>Parent Category</th>
                                                <th>Products</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Category as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td><strong>{{ $value->name }}</strong></td>
                                                <td><code>{{ $value->slung ?? \Illuminate\Support\Str::slug($value->name) }}</code></td>
                                                <td>
                                                    @php
                                                        $parentCategory = DB::table('category')->where('id', $value->cat_id)->value('cat');
                                                    @endphp
                                                    {{ $parentCategory ?? '—' }}
                                                </td>
                                                <td>{{ DB::table('product')->where('sub_cat', $value->id)->count() }}</td>
                                                <td class="center">
                                                    <a href="{{ url('/admin/editSubCategories/' . $value->id) }}" class="btn btn-info btn-sm">
                                                        <i class="icon-pencil icon-white"></i> Edit
                                                    </a>
                                                </td>
                                                <td class="center">
                                                    <a onclick="return confirm('Delete this car model? Products using it may need reassignment.')" href="{{ url('/admin/deleteSubCategory/' . $value->id) }}" class="btn btn-danger btn-sm">
                                                        <i class="icon-trash icon-white"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.right')
    </div>
@endsection
