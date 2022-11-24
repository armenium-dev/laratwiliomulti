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
        {!! Form::checkbox('active', 1, isset($settings) ? $settings->active : null, ['class' => ''] ) !!}
    </div>
</div>

<hr class="mt-20 mb-30">

<h3 class="subtitle mt-0 mb-20">Numbers list</h3>

<ul id="js_numbers_list" class="list-group">
    @foreach($settings->params as $k => $param)
    <li class="js_list_item list-group-item">
        <div class="d-flex">
            <div class="col">{!! Form::text('params['.$k.'][sms_from]', null, ['class' => 'js_sms_from form-control', 'placeholder' => 'SMS From number']) !!}</div>
            <div class="col">{!! Form::text('params['.$k.'][pattern]', null, ['class' => 'form-control', 'placeholder' => 'Trigger pattern (opt). Ex: +44* or *2230 or full number']) !!}</div>
            <div class="col"><label class="m-0">{!! Form::checkbox('params['.$k.'][active]', 1, null, ['class' => ''] ) !!} Status</label></div>
            <div class="col"><a class="js_delete_row btn btn-danger" href="#"><i class="fa fa-trash"></i> Delete</a></div>
        </div>
    </li>
    @endforeach
</ul>

<div class="row">
    <div class="form-group col-sm-12">
        <div class="btn-group">
            <a href="{!! route('laratwiliomultisettings.index') !!}" class="btn btn-default"><i class="fa fa-caret-left"></i> Cancel</a>
            {!! Form::button('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
            <a id="js_add_row" class="js_add_row btn btn-default" href="#"><i class="fa fa-plus"></i> Add new row</a>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		const mode = '{!! $mode !!}';

		let ACE = {
			elements: {
				js_numbers_list: $('#js_numbers_list'),
            },
			Init: function(){
				$(document)
					.on('click', '#js_add_row', ACE.Rows.add)
					.on('click', '.js_delete_row', ACE.Rows.remove);
            },
            Rows: {
				add: function(obj){
                    let $item = ACE.elements.js_numbers_list.find('.js_list_item:last-child').clone(true);
					$item.find('input[type="text"]').val("");
					$item.find('input[type="checkbox"]').attr("checked", false);
					$item = ACE.Rows.renameAttrs($item);
					ACE.elements.js_numbers_list.append($item);
				},
				remove: function(){
                    $(this).parents('.js_list_item').remove();
				},
				renameAttrs: function($cloned_row_item){
					let currentNum = parseInt($cloned_row_item.find('.js_sms_from').attr('name').match(/\d+/));
					let nextNum = currentNum + 1;
					let search = 'params['+currentNum+']';
					let replacement = 'params['+nextNum+']';

					$cloned_row_item.find('input, textarea, select').each(function(index, element){
						if($(element).prop('name')) {
							var prop = $(element).attr('name');
							prop = prop.replace(search, replacement);
							$(element).attr('name', prop);
						}
					});

					return $cloned_row_item;
				},
			}
        };

		ACE.Init();
	});
</script>
