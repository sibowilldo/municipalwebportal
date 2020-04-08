<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, [
        'class'=>'form-control m-input',
        'data-validation'=>'required,length',
        'data-validation-length' => 'max50']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, [
        'class'=>'form-control m-input',
        'data-validation'=>'length,required',
        'data-validation-length' => 'min10' ]) !!}
    <p class="text-right mt-1">
        <span class="m-badge m-badge--metal m-badge--wide"><span id="desc-max-length">500</span> characters left</span></p>
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
    {!! Form::text('location_description', null, [
        'class'=>'form-control m-input',
        'data-validation'=> 'length',
        'data-validation-length' => '10-100']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
            {!! Form::label('longitude', 'Longitude:') !!}
            {!! Form::text('longitude', null, [
                'class'=>'form-control m-input',
                'data-validation'=>'number',
                'data-validation-allowing'=>'range[-180;180],negative,float',
                'data-validation-error-msg' => 'input not a valid longitude value']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
            {!! Form::label('latitude', 'Latitude:') !!}
            {!! Form::text('latitude', null,  [
                'class'=>'form-control m-input',
                'data-validation'=>'number',
                'data-validation-allowing'=>'range[-90;90],negative,float',
                'data-validation-error-msg' => 'input not a valid latitude value']) !!}
        </div>
    </div>
</div>
<div class="form-group m-form__group m--hide{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('suburb_id', 'Suburb:') !!}
    {!! Form::hidden('suburb_id', 0, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id',$categories->pluck('name', 'id'), isset($incident)?($incident->type->categories->first()->id ?? null):null, ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker', 'placeholder'=>'Select a Category...']) !!}

</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('type_id', 'Type:') !!}
    {!! Form::select('type_id', $categories->first()->types()->first()->pluck('name', 'id'), isset($incident)?$incident->type->id:[],  ['class'=>'m-select2 form-control', 'style' => 'width: 100%']) !!}
</div>
<div class="form-group m-form__group{{ $errors->has('') ? ' has-danger' : '' }}">
    {!! Form::label('status_id', 'Status:') !!}
    {!! Form::select('status_id', $statuses->pluck('name', 'id'), null , ['class'=>'form-control m-bootstrap-select m-bootstrap-select--square m_selectpicker selectpicker']) !!}
</div>
{{--\App\Status::where('group', 'incidents')->pluck('name', 'id'), isset($incident) ? $incident->status->id : 1--}}
