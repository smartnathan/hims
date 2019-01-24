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
</div>
<div class="form-group {{ $errors->has('room_number') ? 'has-error' : ''}}">
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
    <div class="col-md-3">
        {!! Form::select('utilities[]', $room_utilities, isset($room) ? $room->utilities->pluck('id') : [], ['id'=> 'room-utilities', 'class' => 'select2 m-b-10 select2-multiple', 'multiple' => true]) !!}
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
    <form id="utility-form" method="POST" action="/dashboard/room-utilities">
            @csrf
    <div class="col-md-2">
       
{!! Form::text('room_utility', null, ['id'=> 'utility-field', 'placeholder'=>'Add More utility', 'class' => 'form-control']) !!}
<div id="succes-message" style="display:none" class="text-success">New Utility added!</div>
    </div>
    <div class="col-md-1">
    <button id="add-util" class="btn btn-primary" type="button">Add</button>
    </div>
    </form>
</div>

<div class="form-group">
    <div class="text-center col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'util-btn btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script type="text/javascript">
     $( document ).ready(function() {
         $('#add-util').on('click', function (e) {
             e.preventDefault();
             var name = $("input[name='room_utility']");

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $.ajax({
                 url: "{{ url('admin/room-utilities') }}",
                 method: "POST",
                 data: {"name": name.val()},
                 dataType: "JSON",
                 success: function (data) {
                     $("#room-utilities").prepend(`<option value="${data.id}">${data.name}</option>`)
                     name.val("");
                     $("#succes-message").fadeIn(2000);
                     $("#succes-message").fadeOut();
                 }
             });
         });
     });
</script>
@endsection
