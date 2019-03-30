<div class="form-group m-form__group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="mb-3">
    <input id="searchMapInput" class="form-control m-input" type="text" placeholder="Enter a location">
    <div id="map"></div>
</div>
<div class="form-group m-form__group">
    {!! Form::label('location_description', 'Location Description:') !!}
    {!! Form::text('location_description', null, ['class'=>'form-control m-input']) !!}
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group m-form__group">
            {!! Form::label('longitude', 'Longitude:') !!}
            {!! Form::text('longitude', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group m-form__group">
            {!! Form::label('latitude', 'Latitude:') !!}
            {!! Form::text('latitude', null, ['class'=>'form-control m-input']) !!}
        </div>
    </div>
</div>
<div class="form-group m-form__group m--hide">
    {!! Form::label('suburb_id', 'Suburb:') !!}
    {!! Form::hidden('suburb_id', 0, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group">
    {!! Form::label('category_id', 'Category:') !!}
    <select name="category_id" id="category_id" class="form-control m-input">
        <option value="0">{{ __('Choose Category...')}}</option>
        @foreach(\App\Category::all(['name', 'id']) as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    {!! Form::select('category_id', \App\Category::pluck('name', 'id'), 6, ['class'=>'form-control m-input']) !!}

</div>
<div class="form-group m-form__group">
    {!! Form::label('type_id', 'Type:') !!}
    {!! Form::select('type_id', [], null, ['class'=>'form-control m-input']) !!}
</div>
<div class="form-group m-form__group">
    {!! Form::label('status_id', 'Status:') !!}
    {!! Form::select('status_id', \App\Status::pluck('name', 'id'), 6, ['class'=>'form-control m-input']) !!}
</div>
