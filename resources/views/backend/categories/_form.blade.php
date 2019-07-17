
{{ csrf_field() }}
<div class="m-portlet__body">
    @include('layouts.form-errors')
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="description" class="col-3 col-form-label">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('is_active') ? ' has-danger' : '' }}">
        <label for="is_active" class="col-3 col-form-label">Active</label>
        <div class="col-9">
             <span class="m-switch with-icon m-switch--icon m-switch--outline m-switch--success">
                <label>
                    <input type="checkbox" name="is_active" @isset($category){{ $category->is_active ? 'checked' : '' }}@endisset>
                    <span></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group m-form__group row{{ $errors->has('types') ? ' has-danger' : '' }}">
        <label for="types" class="col-3 col-form-label">Types</label>
        <div class="col-9">
            {!! Form::select('types[]', $types, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'multiple']) !!}
        </div>
    </div>

    <div class="form-group m-form__group row{{ $errors->has('state_color') ? ' has-danger' : '' }}">
        <label for="state_color" class="col-3 col-form-label">State Color</label>
        <div class="col-9">
            <select name="state_color" id="state_color" class="form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker">
                @foreach($state_colors as $state_color)
                    <option value="{{$state_color}}"
                            data-content="<span class='m-badge m-badge--{{$state_color}} m-badge--dot'></span> {{ title_case($state_color) }}"
                            @isset($category)
                                {{$state_color === $category->state_color ? 'selected' : '' }}
                            @endisset>
                        {{ title_case($state_color) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
