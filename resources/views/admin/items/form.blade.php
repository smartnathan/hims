<div class="form-group {{ $errors->has('item_category_id') ? 'has-error' : ''}}">
    {!! Form::label('item_category_id', 'Item Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('item_category_id', $itemCategories, null, ['class' => 'form-control', 'required' => 'required'] ) !!}
        {!! $errors->first('item_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('item_brand_id') ? 'has-error' : ''}}">
    {!! Form::label('item_brand_id', 'Item Brand', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('item_brand_id', $itemBrand, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('item_brand_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('item_group_id') ? 'has-error' : ''}}">
    {!! Form::label('item_group_id', 'Item Group', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('item_group_id', $itemGroup, null, ['class' => 'form-control', 'required' => 'required'] ) !!}
        {!! $errors->first('item_group_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('has_instances') ? 'has-error' : ''}}">
    {!! Form::label('has_instances', 'Has Instances', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
<div class="radio radio-danger" style="display: inline">
    <input type="radio" name="has_instances" id="radio16" value="1">
    <label for="radio16"> Yes </label>

</div>
<div class="radio radio-danger" style="display: inline">
    <input type="radio" name="has_instances" id="radio17" value="0">
    <label for="radio17"> No </label>

</div>

        {!! $errors->first('has_instances', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    {!! Form::label('is_active', 'Active', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
       <div class="radio radio-danger" style="display: inline">
    <input type="radio" name="is_active" id="radio18" value="0">
    <label for="radio18"> Yes </label>

</div>
<div class="radio radio-danger" style="display: inline">
    <input type="radio" name="is_active" id="radio19" value="0">
    <label for="radio19"> No </label>

</div>
        {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('tag') ? 'has-error' : ''}}">
    {!! Form::label('tag', 'Tag', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tag', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('tag', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    {!! Form::label('quantity', 'Quantity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('oem') ? 'has-error' : ''}}">
    {!! Form::label('oem', 'Oem', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('oem', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('oem', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('warranty_terms') ? 'has-error' : ''}}">
    {!! Form::label('warranty_terms', 'Warranty Terms', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('warranty_terms', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('warranty_terms', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('model_number') ? 'has-error' : ''}}">
    {!! Form::label('model_number', 'Model Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('model_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('model_number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('item_uom_id') ? 'has-error' : ''}}">
    {!! Form::label('item_uom_id', 'Item Uom', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('item_uom_id', $itemUom, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('item_uom_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
