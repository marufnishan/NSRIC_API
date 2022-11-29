<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateRoleModal" aria-hidden="true">
    <form action="" method="PUT" id="updateRoleForm">
        @csrf
        <input type="hidden" id="up_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateProductModal">Update Role</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3">

                    </div>
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input class="form-control" type="text" name="name" id="up_name" placeholder="Product Name">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_role">Update Role</button>
                </div>
            </div>
            </div>
    </form>
</div>