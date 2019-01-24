<div style="display: none; font-size: 15px" id="added-item" class="text-center">
    <strong style="font-size: 20px; color: #2ecc71">Item was succesfully added.</strong>
</div>
                            <div class="row">
                                <div class="col-lg-4">
                        <h5 class="box-title m-t-30">Guest Name</h5>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            <select selected="3" oninvalid="alert('You must fill out the form!')"  id="guest_id" required="required" name="user_id"  class="form-control select2">
            @if ($guests[0]->users)
            <option value="">Select guest</option>
            @foreach ($guests[0]->users as $user)
            <option {{(isset($menuorder) && $menuorder->user->id == $user->id)? "selected" : ""}} value="{{ $user->id}}">{{$user->surname}} {{$user->firstname}} {{$user->othername}} ({{$user->mobile_number}})</option>
            @endforeach
            @endif
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                        <h5 class="box-title m-t-30">Food/Drink</h5>
<div class="form-group {{ $errors->has('menus') ? 'has-error' : ''}}">

                                        <select required="required" id="menu-item" name="menus" class="form-control select2" placeholder="Choose your food or drink">
            <option value="">--Select--</option>
           @foreach($menus as $menu)
           <option {{(isset($menuorder) && $menuorder->menu->id == $menu->id)? "selected" : ""}} value="{{$menu->id}}">{{ $menu->name}} - N{{ $menu->price}}</option>
           @endforeach
</select>


{!! $errors->first('menus', '<p class="help-block">:message</p>') !!}
                                         </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="example">
                                        <h5 class="box-title m-t-30">Quantity</h5>
                                        <select id="quantity" name='quantity' required='required' class = 'form-control select2'>
    <option value="">--Select--</option>
    @for($x = 1;  $x <= 30; $x++)
    <option {{(isset($menuorder) && $menuorder->quantity == $x)? "selected" : ""}}  value="{{$x}}">{{ $x }}</option>
    @endfor
        </select>
        {!! $errors->first('quantities', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-1">
    <div class="form-group">
                                                <h5 class="box-title m-t-30">&nbsp;</h5>

        @if (!isset($menuorder))
        <button style="font-weight: bold" class="btn btn-default btn-add btn-sm" type="button">
                <span class="fa fa-plus"></span> Add Item
        </button>
        @endif
    </div>

</div>
                            </div>
                            @if (isset($menuorder))
                        <div class="form-group">
    <div class="text-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Place Order', ['class' => 'btn-order btn btn-success btn-lg', 'style' => 'font-weight: bold;']) !!}
    </div>
</div>
                            @endif


<div style="display: none" id="menu-order-table">
    <h2 class="box-title m-b-0 text-center" style="font-size: 25px">Food & Drink Requested for by Guest</h2>
    <hr />
<div class="table-responsive">
                                <table id="menu-item-table" class="table color-table danger-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Food/Drinks</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
<div class="form-group">
    <div class="text-center">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Place Order', ['class' => 'btn-order btn btn-danger', 'style' => 'font-weight: bold;']) !!}
    </div>
</div>
</div>
