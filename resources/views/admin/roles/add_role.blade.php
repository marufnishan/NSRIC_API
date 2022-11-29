<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addRoleModal" aria-hidden="true">
    <form action="" method="POST" id="addRoleForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="addRoleModal">Add Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3">

                    </div>
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_role">Create New Role</button>
                </div>
            </div>
            </div>
    </form>
</div>