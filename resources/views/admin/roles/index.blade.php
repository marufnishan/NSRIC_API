@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="my-5 text-center"> <b>All Roles</b> </h2>
            <div class="row">
                <div class="col-md-6"><input type="text" name="search" id="search" class="mb-3 form-control"
                        placeholder="Search role here..."></div>
                <div class="col-md-6">
                    <a class="mb-3 btn btn-success " href="#" data-bs-toggle="modal" data-bs-target="#addModal"><i class="las la-plus"></i>Add Roles</a>
                </div>
            </div>


            <div class="table-bordered">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Role Name</td>
                            <td>Created At</td>
                            <td>Updated At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key=>$role)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>{{$role->updated_at}}</td>
                            <td>
                                <a  href="#"
                                    class="btn btn-primary update_role_form" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#updateModal" 
                                    data-id="{{ $role->id }}"
                                data-name="{{ $role->name }}"
                                ><i class="las la-edit"></i>
                                </a>

                                <a  href="#"
                                    class="btn btn-danger delete_role" 
                                    data-id="{{ $role->id }}"
                                ><i class="las la-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $roles->links() !!}
            </div>
        </div>
    </div>
</div>
@include('admin.roles.add_role')
@include('admin.roles.role_js')
@include('admin.roles.update_role')
@endsection
