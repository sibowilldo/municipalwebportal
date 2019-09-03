
<!--begin:: Log Incident Modal-->
<div class="modal fade" id="log_incident_modal" tabindex="-1" role="dialog" aria-labelledby="logincident"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log Incident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="log-incident" method="POST" action="{{ route('incidents.store') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    @include('backend.incidents._form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary m-btn--pill m-btn--air" data-dismiss="modal">Cancel
                    </button>
                    <button type="submit" class="btn btn-success  m-btn--pill m-btn--air">Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->
