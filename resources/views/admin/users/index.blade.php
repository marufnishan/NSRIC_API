@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="my-5 text-center"> <b>All Users</b> </h2>
            <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Name...">


            <div class="table-bordered">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>User Name</td>
                            <td>Email</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key=>$user)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a  href="{{ route('admin.users.show', $user->id) }}" style="text-decoration: none !important;">
                                    <div class="btn btn-success">
                                        Roles
                                    </div>
                                </a>
                                <a  href="#" 
                                    class="btn btn-danger delete_user" 
                                    data-id="{{ $user->id }}"
                                ><i class="las la-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
</div>
@include('admin.users.user_js')
@endsection
