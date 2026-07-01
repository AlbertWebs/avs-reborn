@extends('admin.master')

@section('content')
<div id="wrap" >
        @include('admin.top')
        @include('admin.left')

        <div id="content">
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <center><h2>Admins</h2></center>
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="display: flex; justify-content: space-between; align-items: center;">
                                <span>Site Admins ({{ count($Admin) }})</span>
                                <a href="{{ url('/admin/addAdmin') }}" class="btn btn-success btn-sm">
                                    <i class="icon-plus icon-white"></i> Add Admin
                                </a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Position</th>
                                                <th>Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Admin as $value)
                                            <tr class="odd gradeX">
                                                <td>{{ $value->id }}</td>
                                                <td><strong>{{ $value->name }}</strong></td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->position ?? '—' }}</td>
                                                <td>
                                                    <center>
                                                        @if($value->image)
                                                            <img width="60" height="60" style="object-fit: cover; border-radius: 6px;" src="{{ url('/') }}/uploads/admins/{{ $value->image }}" alt="{{ $value->name }}">
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </center>
                                                </td>
                                                <td class="center">
                                                    <a href="{{ url('/admin/editAdmin/' . $value->id) }}" class="btn btn-info btn-sm">
                                                        <i class="icon-pencil icon-white"></i> Edit
                                                    </a>
                                                </td>
                                                @if($value->id == 1)
                                                <td class="center">
                                                    <a onclick="return alert('You cannot delete the Super Admin')" href="#" class="btn btn-danger btn-sm">
                                                        <i class="icon-trash icon-white"></i> Del
                                                    </a>
                                                </td>
                                                @else
                                                <td class="center">
                                                    <a onclick="return confirm('Delete this admin?')" href="{{ url('/admin/deleteAdmin/' . $value->id) }}" class="btn btn-danger btn-sm">
                                                        <i class="icon-trash icon-white"></i> Del
                                                    </a>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.right')
    </div>
@endsection
