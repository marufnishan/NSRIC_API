<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addPermissionModal" aria-hidden="true">
    <form action="" method="POST" id="addPermissionForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="addPermissionModal">Add Permission</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3">

                    </div>
                    <div class="form-group">
                        <label for="name">Permission Name</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="Permission Name">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_permission">Create New Permission</button>
                </div>
            </div>
            </div>
    </form>
</div>