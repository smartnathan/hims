<div class="form-group {{ $errors->has('item_id') ? 'has-error' : ''}}">
    {!! Form::label('item_id', 'Item Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('item_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('item_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('quantity_at_hand') ? 'has-error' : ''}}">
    {!! Form::label('quantity_at_hand', 'Quantity At Hand', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('quantity_at_hand', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('quantity_at_hand', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('added_by') ? 'has-error' : ''}}">
    {!! Form::label('added_by', 'Added By', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('added_by', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('added_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
