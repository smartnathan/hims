@if (request()->has('type') && request()->get('type') == 'guest' && Auth::user()->hasRole('receptionist'))
<div class="row">
<div class="col-md-12">

<div class="panel panel-info">

<div class="panel-wrapper collapse in" aria-expanded="true">

<div class="panel-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
<form action="#">
<div class="form-body">
<h3 class="box-title">Personal Information</h3>
<hr>
<div class="row">
<div class="col-md-4">
<div class="form-group {{ $errors->has('surname') ? ' has-error' : ''}}">
    <label class="control-label">Surname <span class="text-danger">*</span></label>
    {!! Form::text('surname', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
<div class="col-md-4">
<div class="form-group {{ $errors->has('firstname') ? ' has-error' : ''}}">
    <label class="control-label">First Name <span class="text-danger">*</span></label>
    {!! Form::text('firstname', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->

<!--/span-->
<div class="col-md-4">
<div class="form-group {{ $errors->has('othername') ? ' has-error' : ''}}">
    <label class="control-label">Other Name <span class="text-danger">*</span></label>
    {!! Form::text('othername', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('othername', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->
<div class="row">
<div class="col-md-6">
<div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
    <label for="gender">Gender <span class="text-danger">*</span></label>
        {!! Form::select('gender', ['' => '--Select--', 'male' => 'Male', 'female' => 'Female'], isset($user) ? "{$user->gender}" : 'null', ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
        </div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group{{ $errors->has('desgination') ? ' has-error' : ''}}">
    <label for="desgination">Designation <span class="text-danger">*</span></label>
        {!! Form::select('designation', ['' => '--Select--', 'Miss' => 'Miss', 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Dr.' => 'Dr.', 'Engr.' => 'Engr.', 'Chief' => 'Chief', 'Pastor' => 'Pastor', 'Rev.' => 'Rev.', 'Senator.' => 'Senator', 'Prof.' => 'Prof.', 'Prophet' => 'Prophet'], isset($user) ? "{$user->designation}" : 'null', ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('designation', '<p class="text-danger">:message</p>') !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->
<div class="row">
<div class="col-md-6">
<div class="form-group{{ $errors->has('occupation_id') ? ' has-error' : ''}}">
    <label for="occupation_id"> Occupation <span class="text-danger">*</span></label>
    {!! Form::select('occupation_id', $occupations, isset($user) ? $user->occupation_id: '', ['class' => 'form-control select2', 'required' => 'required']) !!}
{!! $errors->first('occupation_id', '<p class="text-danger">:message</p>') !!}
</div>

</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group {{ $errors->has('vehicle_number') ? ' has-error' : ''}}">
    <label class="control-label">Vehicle Number (optional)</label>
    {!! Form::text('vehicle_number', null, ['class' => 'form-control']) !!}
    {!! $errors->first('vehicle_number', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->
<h3 class="box-title m-t-40">Contact Information</h3>
<hr>
<div class="row">
<div class="col-md-6">
<div class="form-group {{ $errors->has('mobile_number') ? ' has-error' : ''}}">
    <label class="control-label">Mobile Number <span class="text-danger">*</span></label>
    {!! Form::number('mobile_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('mobile_number', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('email') ? ' has-error' : ''}}">
    <label class="control-label">Email address</label>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group {{ $errors->has('address') ? ' has-error' : ''}}">
    <label class="control-label">Contact address <span class="text-danger">*</span></label>
    {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group">
    <label>Nationality</label>
     {!! Form::select('nationality_id', $nationalities, isset($user) ? $user->nationality_id: '', ['class' => 'form-control select2', 'required' => 'required']) !!}
     </div>
</div>
<!--/span-->
</div>
<!--/row-->
<div class="row">
<div class="col-md-6">
    <div class="form-group{{ $errors->has('state_id') ? ' has-error' : ''}}">
    {!! Form::label('state', 'State: ') !!}
    {!! Form::select('state_id', $states, isset($user) ? $user->lga->state->id : '', ['id' => 'state', 'class' => 'form-control select2', 'required' => 'required']) !!}
</div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group{{ $errors->has('lga') ? ' has-error' : ''}}">
    <label for="lga">LGA <span class="text-danger">*</span></label>

       <select  id="lga" class="form-control select2" name="lga_id">
           <option value=''>--Select--</option>
           @if (isset($user))
           <option selected="selected" value="{{ $user->lga->id }}">{{ $user->lga->name }}</option>
           @endif
       </select>
        {!! $errors->first('lga_id', '<p class="text-danger">:message</p>') !!}
      </div>
</div>
<!--/span-->
</div>
</div>
<div class="form-actions">
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : "Create", ['class' => 'btn btn-success']) !!}
<a class="btn btn-default" href="{{ url('/admin/users')}}">Cancel</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<!--./row-->
@endif


@if (Auth::user()->hasRole('admin'))

<div class="row">
<div class="col-md-12">

<div class="panel panel-info">

<div class="panel-wrapper collapse in" aria-expanded="true">

<div class="panel-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
<form action="#">
<div class="form-body">
<h3 class="box-title">Personal Information</h3>
<hr>
<div class="row">
<div class="col-md-4">
<div class="form-group {{ $errors->has('surname') ? ' has-error' : ''}}">
    <label class="control-label">Surname <span class="text-danger">*</span></label>
    {!! Form::text('surname', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
<div class="col-md-4">
<div class="form-group {{ $errors->has('firstname') ? ' has-error' : ''}}">
    <label class="control-label">First Name <span class="text-danger">*</span></label>
    {!! Form::text('firstname', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->

<!--/span-->
<div class="col-md-4">
<div class="form-group {{ $errors->has('othername') ? ' has-error' : ''}}">
    <label class="control-label">Other Name <span class="text-danger">*</span></label>
    {!! Form::text('othername', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('othername', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->
<div class="row">
<div class="col-md-6">
<div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
    <label for="gender">Gender <span class="text-danger">*</span></label>
        {!! Form::select('gender', ['' => '--Select--', 'male' => 'Male', 'female' => 'Female'], isset($user) ? "{$user->gender}" : 'null', ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
        </div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group{{ $errors->has('desgination') ? ' has-error' : ''}}">
    <label for="desgination">Designation <span class="text-danger">*</span></label>
        {!! Form::select('designation', ['' => '--Select--', 'Miss' => 'Miss', 'Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Dr.' => 'Dr.', 'Engr.' => 'Engr.', 'Chief' => 'Chief', 'Pastor' => 'Pastor', 'Rev.' => 'Rev.', 'Senator.' => 'Senator', 'Prof.' => 'Prof.', 'Prophet' => 'Prophet'], isset($user) ? "{$user->designation}" : 'null', ['class' => 'form-control', 'required' => 'required']); !!}
        {!! $errors->first('designation', '<p class="text-danger">:message</p>') !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->

<h3 class="box-title m-t-40">Login Information</h3>
<hr>

<div class="row">
<div class="col-md-6">

<div class="form-group {{ $errors->has('username') ? ' has-error' : ''}}">
    <label class="control-label">Username <span class="text-danger">*</span></label>
    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('password') ? ' has-error' : ''}}">
    <label class="control-label">Password <span class="text-danger">*</span></label>
    <input type="password" name="password" class="form-control">
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
</div>
</div>



<h3 class="box-title m-t-40">Contact Information</h3>
<hr>
<div class="row">
<div class="col-md-6">
<div class="form-group {{ $errors->has('mobile_number') ? ' has-error' : ''}}">
    <label class="control-label">Mobile Number <span class="text-danger">*</span></label>
    {!! Form::number('mobile_number', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('mobile_number', '<p class="help-block">:message</p>') !!}
</div>
</div>
<div class="col-md-6">
<div class="form-group {{ $errors->has('email') ? ' has-error' : ''}}">
    <label class="control-label">Email address</label>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group {{ $errors->has('address') ? ' has-error' : ''}}">
    <label class="control-label">Contact address <span class="text-danger">*</span></label>
    {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
<label for="roles">Roles <span class="text-danger">*</span></label>
{!! Form::select('roles[]', $roles, isset($user_roles) ? $user_roles : [], ['multiple' => true, 'class' => "select2", 'required'=> "required"]) !!}
</div>
</div>
<!--/span-->
</div>
<!--/row-->
<div class="row">
<div class="col-md-6">
    <div class="form-group{{ $errors->has('state_id') ? ' has-error' : ''}}">
    {!! Form::label('state', 'State: ') !!}
    {!! Form::select('state_id', $states, isset($user) ? $user->lga->state->id : '', ['id' => 'state', 'class' => 'form-control', 'required' => 'required']) !!}
</div>
</div>
<!--/span-->
<div class="col-md-6">
<div class="form-group{{ $errors->has('lga') ? ' has-error' : ''}}">
    <label for="lga">LGA <span class="text-danger">*</span></label>

       <select  id="lga" class="form-control" name="lga_id">
           <option value=''>--Select--</option>
           @if (isset($user))
           <option selected="selected" value="{{ $user->lga->id }}">{{ $user->lga->name }}</option>
           @endif
       </select>
        {!! $errors->first('lga_id', '<p class="text-danger">:message</p>') !!}
      </div>
</div>
<!--/span-->
</div>
</div>
<div class="form-actions">
{!! Form::submit(isset($submitButtonText) ? $submitButtonText : "Create", ['class' => 'btn btn-success']) !!}
<a class="btn btn-default" href="{{ url('/admin/users')}}">Cancel</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<!--./row-->

@endif

@section('scripts')
<script>
    $(document).ready(function() {
        // Login to populate local government area from selected
        //state, beigins here
        $("#state").change(() => {
            let state = $("#state").val();
            $('#lga').children('option:not(:first)').remove();
           $.ajax({
            type: "GET",
            url: "/admin/users/lga",
            data: { state_id : state }
           }).done(function(data){
                    $.each(data, function(index, item){
                        $("#lga").append(`
                     <option value="${item.id}">${item.name}</option>
                     `);
                    });
           });
        });
    });
        </script>

@endsection
