<div class="form-group {{ $errors->has('room_id') ? 'has-error' : ''}}">
    {!! Form::label('room_id', 'Room Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="text" class="form-control" value="{{$booking->room->name}}" disabled="disabled" name="room_id">
    </div>
</div><div class="form-group {{ $errors->has('arrival_date') ? 'has-error' : ''}}">
    {!! Form::label('arrival_date', 'Arrival Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="text" disabled="disabled" name="arrival_date" class="form-control" value="{{date('m/d/Y,h:i A', strtotime($booking->arrival_date))}}">
    </div>
</div>

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'Guest Full Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="text" class="form-control" name="user_id" disabled="disabled" value="{{$booking->user->full_name}}">
    </div>
</div><div class="form-group {{ $errors->has('checked_in_by') ? 'has-error' : ''}}">
    {!! Form::label('checked_in_by', 'Checked In By', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="text" name="checked_in_by" class="form-control" disabled="disabled" value="{{$booking->staff->full_name}}">
    </div>
</div>
<div class="form-group {{ $errors->has('paid') ? 'has-error' : ''}}">
    {!! Form::label('paid', 'Payment Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @if ($booking->paid == 1) <span style="" class="label label-success">Payment Completed</span> @else <span class="label label-danger">Payment Pending</span>@endif
    </div>
</div>
<div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Duration', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="number" name="duration" value="{{old('duration')}}" required="required" class="form-control">
    </div>
</div>



@if ($booking->paid == 1)
    <div class="form-group">
        <label for="paid" class="col-md-4 control-label">Paid<span class="text-danger">*</span></label>
        <div class="col-sm-6">
            <div class="radio radio-primary">
                <input required="" id="paid" type="radio" name="paid" id="radio1" value="0">
                <label for="radio1"> No </label>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input required="" id="paid" type="radio" name="paid" id="radio2" value="1">
                <label for="radio2"> Yes </label>
            </div>

        </div>
    </div>
    <div id="paymenttype" class="form-group" style="display: none;">
        <label for="paymenttype" class="col-md-4 control-label">Payment Type<span class="text-danger">*</span></label>
        <div class="col-md-6">
            <select name="paymenttype" class="form-control select2">
                <option value="">--Select--</option>
                @foreach ( $paymenttype as $type )
                    <option value="{{ $type->id }}">
                        {{ $type->name}}
                    </option>
                @endforeach

            </select>
        </div>
    </div>
    @endif


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-danger']) !!}
    </div>
</div>

