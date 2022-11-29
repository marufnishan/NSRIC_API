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