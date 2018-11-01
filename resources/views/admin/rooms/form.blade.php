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

<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
    {!! Form::label('label', 'Room Utilities: ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('utilities[]', $room_utilities, isset($room) ? $room->utilities->pluck('id') : [], ['class' => 'select2 m-b-10 select2-multiple', 'multiple' => true]) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="text-center col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
{{-- <style type="text/css">
    .spacer {
        margin: 10px 0 ;
    }
</style> --}}
{{-- Begin facility form --}}
{{-- <div class="room-facility  text-center">
  <div class="entry form-inline">
<div class="form-group">
    <div class="col-md-12">
        {!! Form::text('fname[]', null, ['placeholder' => 'Facility Name', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {!! Form::text('fcompany_tag[]', null, ['placeholder' => 'Company Tag', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {!! Form::text('fdescription[]', null, ['placeholder' => 'Description', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <button type="button"  class="add-facility btn btn-success"><span class="fa fa-plus"></span> Add New</button>
    </div>
</div>
</div>
</div> --}}

{{-- End facility form --}}


@section('scripts')
<script type="text/javascript">
    // $( document ).ready(function() {
    //         $(document).on('click', '.add-facility', function(e) {
    //             e.preventDefault();

    //             var tableFields = $('.room-facility'),
    //                 currentEntry = $(this).parents('.entry:first'),
    //                 newEntry = $(currentEntry.clone()).appendTo(tableFields);

    //             newEntry.find('input').val('');
    //             tableFields.find('.entry:not(:last) .add-facility')
    //                 .removeClass('add-facility').addClass('btn-remove')
    //                 .removeClass('btn-success').addClass('btn-danger')
    //                 .html('<span class="fa fa-minus"></span> Remove');
    //         }).on('click', '.btn-remove', function(e) {
    //             $(this).parents('.entry:first').remove();

    //             e.preventDefault();
    //             return false;
    //         });

    //     });
</script>
@endsection
