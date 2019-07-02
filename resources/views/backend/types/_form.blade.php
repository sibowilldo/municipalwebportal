
{{ csrf_field() }}
<div class="m-portlet__body">
    @include('layouts.form-errors')
    <div class="form-group m-form__group row">
        <label for="name" class="col-3 col-form-label{{ $errors->has('name') ? ' has-danger' : '' }}">Name</label>
        <div class="col-9">
            {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="description" class="col-3 col-form-label{{ $errors->has('description') ? ' has-danger' : '' }}">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="is_active" class="col-3 col-form-label{{ $errors->has('is_active') ? ' has-danger' : '' }}">Active</label>
        <div class="col-9">
             <span class="m-switch with-icon m-switch--icon m-switch--outline m-switch--success">
                <label>
                    <input type="checkbox" name="is_active" @isset($type){{ $type->is_active ? 'checked' : '' }}@endisset>
                    <span></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group m-form__group row">
        <label for="types" class="col-3 col-form-label{{ $errors->has('categories') ? ' has-danger' : '' }}">Categories</label>
        <div class="col-9">
            {!! Form::select('categories[]', $categories, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'multiple']) !!}
        </div>
    </div>

    <div class="form-group m-form__group row">
        <label for="state_color" class="col-3 col-form-label{{ $errors->has('state_color') ? ' has-danger' : '' }}">State Color</label>
        <div class="col-9">
            <select name="state_color" id="state_color" class="form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker">
                @foreach($state_colors as $state_color)
                    <option value="{{$state_color}}"
                            data-content="<span class='m-badge m-badge--{{$state_color}} m-badge--dot'></span> {{ title_case($state_color) }}"
                    @isset($type)
                        {{$state_color === $type->state_color ? 'selected' : '' }}
                            @endisset>
                        {{ title_case($state_color) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
