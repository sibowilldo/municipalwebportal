
{{ csrf_field() }}
<div class="m-portlet__body">
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('css_class') ? ' has-danger' : '' }}">
        <label for="css_class" class="col-3 col-form-label">CSS Class</label>
        <div class="col-9">
            {!! Form::text('css_class', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('css_color') ? ' has-danger' : '' }}">
        <label for="css_color" class="col-3 col-form-label">CSS Color</label>
        <div class="col-9">
            {!! Form::text('css_color', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
</div>
