<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    <div class="mb-3">
        {!! Form::label('map', 'Search Location:') !!}
        <input id="searchMapInput" class="form-control m-input" type="text" placeholder="Enter a location">
        <div id="map"></div>
    </div>
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('location_description', 'Location Description:') !!}
    {!! Form::text('location_description', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
            {!! Form::label('longitude', 'Longitude:') !!}
            {!! Form::text('longitude', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
            {!! Form::label('latitude', 'Latitude:') !!}
            {!! Form::text('latitude', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
</div>
<div class="form-group m-form__group m--hide{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('suburb_id', 'Suburb:') !!}
    {!! Form::hidden('suburb_id', 0, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories->pluck('name', 'id'), null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'placeholder'=>'Select a Category...']) !!}

</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('type_id', 'Type:') !!}
    {!! Form::select('type_id', [], null, ['class'=>'m-select2 form-control', 'style' => 'width: 100%']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('status_id', 'Status:') !!}
    {!! Form::select('status_id', \App\Status::pluck('name', 'id'), 6, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
</div>
