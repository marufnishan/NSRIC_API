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