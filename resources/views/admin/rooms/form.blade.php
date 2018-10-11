<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('roomtype_id') ? 'has-error' : ''}}">
    {!! Form::label('roomtype_id', 'Room Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('roomtype_id', $roomtypes, isset($room) ? $room->roomtype_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('roomtype_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('description', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('room_number') ? 'has-error' : ''}}">
    {!! Form::label('room_number', 'Room Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('room_number', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('room_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="page-header">
    <h2 class="text-center">Room Facilitites</h2>
</div>


{{-- Begin facility form --}}
<div class="row" id="room-facility" style="margin: 15px">
  <div class="entry">
<div class="form-grop">
    <div class="col-md-3">
        {!! Form::text('fname', null, ['placeholder' => 'Facility Name', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-grup">
    <div class="col-md-3">
        {!! Form::text('company_tag', null, ['placeholder' => 'Company Tag', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-grou">
    <div class="col-md-4">
        {!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-grou">
    <div class="col-md-2">
        <button type="button"  class="add-facility btn btn-success">Add</button>
    </div>
</div>
</div>

</div>
{{-- End facility form --}}
<div id="new-form">

</div>


<div class="form-group">
    <div class="text-center col-md-offset-4 col-md-4" style="margin-top: 20px">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-facility').on('click', function(){
            //var room = $('#room-facility').clone().appendTo('#new-form');
            var roomFacility = $('#room-facility'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(roomFacility);

            newEntry.find('input').val('');
            roomFacility.find('.entry:not(:last) .add-facility')
                    .removeClass('add-facility').addClass('remove-facility')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span> Remove');
        }).on('click', '.remove-facility', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
    });
</script>
@endsection
