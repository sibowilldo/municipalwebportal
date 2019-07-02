<!--begin::Modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="update_reason" class="form-control-label">Type Reason Here:</label>
                        <textarea class="form-control" id="update_reason" name="update_reason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger m-btn--pill delete-modal"
                        data-id="{{ $id }}"
                        data-url="{{ $url }}" >Confirm</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->