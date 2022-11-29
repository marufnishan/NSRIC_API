@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="my-5 text-center"> <b>All Permissions</b> </h2>
            <div class="row">
                <div class="col-md-6"><input type="text" name="search" id="search" class="mb-3 form-control"
                        placeholder="Search role here..."></div>
                <div class="col-md-6">
                    <a class="mb-3 btn btn-success " href="#" data-bs-toggle="modal" data-bs-target="#addModal"><i class="las la-plus"></i>Add Permissions</a>
                </div>
            </div>


            <div class="table-bordered">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Permission Name</td>
                            <td>Created At</td>
                            <td>Updated At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $key=>$permission)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->created_at}}</td>
                            <td>{{$permission->updated_at}}</td>
                            <td>
                                <a  href="#"
                                    class="btn btn-primary update_permission_form" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateModal" 
                                    data-id="{{ $permission->id }}"
                                data-name="{{ $permission->name }}"
                                ><i class="las la-edit"></i>
                                </a>

                                <a  href="#"
                                    class="btn btn-danger delete_permission" 
                                    data-id="{{ $permission->id }}"
                                ><i class="las la-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $permissions->links() !!}
            </div>
        </div>
    </div>
</div>
@include('admin.permissions.add_permission')
@include('admin.permissions.permission_js')
@include('admin.permissions.update_permission')
@endsection
