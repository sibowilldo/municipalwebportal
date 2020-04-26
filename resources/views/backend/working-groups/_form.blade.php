
{{ csrf_field() }}
@include('layouts.form-errors')
<div class="m-portlet__body">
    <div class="form-group m-form__group row{{ $errors->has('leader') ? ' has-danger' : '' }}">
        <label for="types" class="col-3 col-form-label">Select Superintendent</label>
        <div class="col-9">
            {!! Form::select('leader', $leaders->pluck('fullname', 'uuid'), $current_leader->uuid??null,
            ['class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker',
            'data-live-search' => "true",
            isset($current_leader)?'disabled':''] ) !!}
        </div>
        @isset($current_leader)
            {!! Form::hidden('leader', $current_leader->uuid) !!}
        @endisset
    </div>
    @isset($group_engineers)
    <div class="form-group m-form__group row{{ $errors->has('leader') ? ' has-danger' : '' }}">
        <label for="types" class="col-3 col-form-label">Assigned Engineers</label>
        <div class="col-9">
            {!! Form::select('assigned_engineers[]', $group_engineers->pluck('fullname', 'id'), $group_engineers->pluck('id'), ['multiple'=>true, 'class' => 'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}

            <p class="m-form__help mt-3">Uncheck name to unassign engineer. Caution: Only Superintendents can assign engineers to groups</p>
        </div>
    </div>
    @endisset
    @if(isset($incident))
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="incident_id" class="col-3 col-form-label">Incident Name</label>
        <div class="col-9">
            {!! Form::text('disabled_incident_name', $incident->name, ['class'=>'form-control m-input', 'disabled' => 'disabled']) !!}
            {!! Form::hidden('incident_uuid', $incident->uuid) !!}
        </div>
    </div>
    @endif
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', $name=null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="description" class="col-3 col-form-label">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', $description=null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('is_active') ? ' has-danger' : '' }}">
        <label for="is_active" class="col-3 col-form-label">Active</label>
        <div class="col-9">
             <span class="m-switch with-icon m-switch--icon m-switch--outline m-switch--success">
                <label>
                    <input type="checkbox" name="is_active" @isset($working_group){{ $working_group->is_active ? 'checked' : '' }}@endisset>
                    <span></span>
                </label>
            </span>
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('status_id') ? ' has-danger' : '' }}">
        <label for="types" class="col-3 col-form-label">Status</label>
        <div class="col-9">
            {!! Form::select('status_id', $statuses->pluck('name', 'id'), $working_group->status->id??null, [ "data-live-search"=>"true", "class" => "form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker"]) !!}
        </div>
    </div>
</div>
