
{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="form-group m-form__group row{{ $errors->has('leader') ? ' has-danger' : '' }}">
        <label for="types" class="col-3 col-form-label">Select Leader</label>
        <div class="col-9">
            <select name="leader" id="leader" class="form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker" data-live-search="true">
                @foreach($leaders as $leader)
                    <option value="{{ $leader->id }}"  data-subtext="{{ $leader->email }}" @isset($current_leader){{ $current_leader->uuid == $leader->uuid ? 'selected':'' }}@endisset>{{ $leader->fullname }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
</div>
