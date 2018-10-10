<div class="form-group {{ $errors->has('room_id') ? 'has-error' : ''}}">
    {!! Form::label('room_id', 'Room Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('room_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('arrival_date') ? 'has-error' : ''}}">
    {!! Form::label('arrival_date', 'Arrival Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'arrival_date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('arrival_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('departure_date') ? 'has-error' : ''}}">
    {!! Form::label('departure_date', 'Departure Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'departure_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('departure_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('checked_in_by') ? 'has-error' : ''}}">
    {!! Form::label('checked_in_by', 'Checked In By', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('checked_in_by', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('checked_in_by', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('checked_out_by') ? 'has-error' : ''}}">
    {!! Form::label('checked_out_by', 'Checked Out By', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('checked_out_by', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('checked_out_by', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('paid') ? 'has-error' : ''}}">
    {!! Form::label('paid', 'Paid', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="checkbox">
    <label>{!! Form::radio('paid', '1') !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('paid', '0', true) !!} No</label>
</div>
        {!! $errors->first('paid', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('payment_type_id') ? 'has-error' : ''}}">
    {!! Form::label('payment_type_id', 'Payment Type Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('payment_type_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('payment_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('duration', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('is_cancealed') ? 'has-error' : ''}}">
    {!! Form::label('is_cancealed', 'Is Cancealed', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="checkbox">
    <label>{!! Form::radio('%1$s', '1') !!} Yes</label>
</div>
<div class="checkbox">
    <label>{!! Form::radio('%1$s', '0', true) !!} No</label>
</div>
        {!! $errors->first('is_cancealed', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('date_cancealed') ? 'has-error' : ''}}">
    {!! Form::label('date_cancealed', 'Date Cancealed', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime-local', 'date_cancealed', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('date_cancealed', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
