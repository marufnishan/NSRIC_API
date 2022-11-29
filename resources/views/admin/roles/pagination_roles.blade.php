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
            <td>{{$contuct->id}}</td>
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