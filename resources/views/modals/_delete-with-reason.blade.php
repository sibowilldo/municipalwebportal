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
            <form id="deleteWithReason" method="post" action="{{ $url }}">
            <div class="modal-body">
                    <div class="form-group">
                        <label for="delete_reason" class="form-control-label">Type Reason Here:</label>
                        {{ Form::hidden('id', $id) }}
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
{{--                        ToDo: Remove reason template --}}
                        <textarea class="form-control" id="delete_reason" name="delete_reason" data-validation="required,length" data-validation-length="min100">These are my one hundred characters required to pass the minimum character test using jquery formvalidator.
                        </textarea>
                        <p class="text-right mt-1">
                            <span class="m-badge m-badge--danger m-badge--wide"><span id="delete_reason-max-length">500</span> characters left</span></p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark m-btn--pill" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger m-btn--pill pull-right">Yes! Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--end::Modal-->
