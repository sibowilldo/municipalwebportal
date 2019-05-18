
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
        <label for="district" class="col-3 col-form-label{{ $errors->has('district') ? ' has-danger' : '' }}">District</label>
        <div class="col-9">
            {!! Form::text('district', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="description" class="col-3 col-form-label{{ $errors->has('description') ? ' has-danger' : '' }}">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="contact_number" class="col-3 col-form-label{{ $errors->has('contact_number') ? ' has-danger' : '' }}">Contact Number</label>
        <div class="col-9">
            {!! Form::tel('contact_number', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="email" class="col-3 col-form-label{{ $errors->has('email') ? ' has-danger' : '' }}">Email</label>
        <div class="col-9">
            {!! Form::email('email', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="alt_contact_number" class="col-3 col-form-label{{ $errors->has('alt_contact_number') ? ' has-danger' : '' }}">Alt. Contact Number</label>
        <div class="col-9">
            {!! Form::tel('alt_contact_number', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="address" class="col-3 col-form-label{{ $errors->has('address') ? ' has-danger' : '' }}">Address</label>
        <div class="col-9">
            {!! Form::textarea('address', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row">
        <label for="status_is" class="col-3 col-form-label{{ $errors->has('status_is') ? ' has-danger' : '' }}">Status</label>
        <div class="col-9">
            {!! Form::select('status_is', $statuses, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
        </div>
    </div>
</div>
