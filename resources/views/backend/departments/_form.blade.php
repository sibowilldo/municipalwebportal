
{{ csrf_field() }}
    @include('layouts.form-errors')
<div class="m-portlet__body">
    <div class="form-group m-form__group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="col-3 col-form-label">Name</label>
        <div class="col-9">
            {!! Form::text('name', 'Water Services', ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('district') ? ' has-danger' : '' }}">
        <label for="district_id" class="col-3 col-form-label">District</label>
        <div class="col-9">
                {!! Form::select('district_id', $districts, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('description') ? ' has-danger' : '' }}">
        <label for="description" class="col-3 col-form-label">Description</label>
        <div class="col-9">
            {!! Form::textarea('description', '​This department is responsible for the provision of the core services: Water, Sanitation and Environmental Services Under Water Services there are various Sections', ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
        <label for="contact_number" class="col-3 col-form-label">Contact Number</label>
        <div class="col-9">
            {!! Form::tel('contact_number', '039 688 5841', ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label for="email" class="col-3 col-form-label">Email</label>
        <div class="col-9">
            {!! Form::email('email', 'enquiries@ugu.gov.za', ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('address') ? ' has-danger' : '' }}">
        <label for="address" class="col-3 col-form-label">Address</label>
        <div class="col-9">
            {!! Form::textarea('address', '28 Connor Street, Port Shepstone, 4240', ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('category') ? ' has-danger' : '' }}">
        <label for="category_id" class="col-3 col-form-label">Category</label>
        <div class="col-9">
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
        </div>
    </div>
    <div class="form-group m-form__group row{{ $errors->has('status_id') ? ' has-danger' : '' }}">
        <label for="status_is" class="col-3 col-form-label">Status</label>
        <div class="col-9">
            {!! Form::select('status_id', $statuses, null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
        </div>
    </div>
</div>
