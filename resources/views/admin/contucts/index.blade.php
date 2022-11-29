@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2 class="my-5 text-center"> <b>All Contucts</b></h2>
            <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Contuct">
            <div class="table-bordered">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Message</td>
                            <td>Created_At</td>
                            <td>Updated_At</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contucts as $key=>$contuct)
                        <tr class="table-active">
                            <td>{{$key+1}}</td>
                            <td>{{$contuct->name}}</td>
                            <td>{{$contuct->email}}</td>
                            <td>{{$contuct->phone}}</td>
                            <td>{{$contuct->message}}</td>
                            <td>{{$contuct->created_at}}</td>
                            <td>{{$contuct->updated_at}}</td>
                            <td>
                                <a  href="#"
                                    class="btn btn-danger delete_contuct" 
                                    data-id="{{ $contuct->id }}"
                                ><i class="las la-times"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $contucts->links() !!}
            </div>
        </div>
    </div>
</div>
@include('admin.contucts.contucts_js')
@endsection