<h3 class="subtitle mt-0 mb-20">Account params</h3>

<div class="row">
    <div class="form-group col-sm-3">
        {!! Form::label('name', 'Custom Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Example: Twilio Account 1']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('account_sid', 'Twilio Account SID:') !!}
        {!! Form::text('account_sid', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('auth_token', 'Twilio Account Token:') !!}
        {!! Form::text('auth_token', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('active', 'Active status:') !!}<br>
        {!! Form::checkbox('active', null, null, ['class' => ''] ) !!}
    </div>
</div>

<hr class="mt-20 mb-30">

<h3 class="subtitle mt-0 mb-20">Numbers list</h3>

<ul id="js_numbers_list" class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-sm-5"><input type="text" name="params[0][sms_from]" class="form-control" placeholder="SMS From number"></div>
            <div class="col-sm-5"><input type="text" name="params[0][pattern]" class="form-control" placeholder="Trigger pattern (optional). Example: +44* or *2230 or full number"></div>
            <div class="col-sm-1"><label class="m-0"><input type="checkbox" name="params[0][active]" value="1"> Status</label></div>
            <div class="col-sm-1"><a class="js_delete_row btn btn-danger" href="#"><i class="fa fa-trash"></i> Delete</a></div>
        </div>
    </li>
</ul>

<div class="row">
    <div class="form-group col-sm-12">
        <div class="btn-group">
            <a href="{!! route('laratwiliomultisettings.index') !!}" class="btn btn-default"><i class="fa fa-caret-left"></i> Cancel</a>
            {!! Form::button('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            <a class="js_add_row btn btn-default" href="#"><i class="fa fa-plus"></i> Add new row</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
		var mode = '{!! $mode !!}';
    });
</script>
