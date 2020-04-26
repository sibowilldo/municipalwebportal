
{{ csrf_field() }}
@include('layouts.form-errors')
<div class="m-portlet__body">
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label for="email" class="col-3 col-form-label">Email</label>
        <div class="col-9">
            {!! Form::email('email', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
        <label for="contact_number" class="col-3 col-form-label">Contact Number</label>
        <div class="col-9">
            {!! Form::tel('contact_number', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('website') ? ' has-danger' : '' }}">
        <label for="website" class="col-3 col-form-label">Website</label>
        <div class="col-9">
            {!! Form::url('website', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
</div>
