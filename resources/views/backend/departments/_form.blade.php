
{{ csrf_field() }}
<div class="m-portlet__body">
    @include('layouts.form-errors')
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('district') ? ' has-danger' : '' }}">
        <label for="district" class="col-3 col-form-label">District</label>
        <div class="col-9">
            {!! Form::text('district', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="description" class="col-3 col-form-label">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
        <label for="contact_number" class="col-3 col-form-label">Contact Number</label>
        <div class="col-9">
            {!! Form::tel('contact_number', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label for="email" class="col-3 col-form-label">Email</label>
        <div class="col-9">
            {!! Form::email('email', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('alt_contact_number') ? ' has-danger' : '' }}">
        <label for="alt_contact_number" class="col-3 col-form-label">Alt. Contact Number</label>
        <div class="col-9">
            {!! Form::tel('alt_contact_number', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('address') ? ' has-danger' : '' }}">
        <label for="address" class="col-3 col-form-label">Address</label>
        <div class="col-9">
            {!! Form::textarea('address', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('status_is') ? ' has-danger' : '' }}">
        <label for="status_is" class="col-3 col-form-label">Status</label>
        <div class="col-9">
            {!! Form::select('status_is', $statuses, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
        </div>
    </div>
</div>
