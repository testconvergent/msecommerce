<script src="chosen/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
$(".chosen-select").chosen({ width:"100%" });
</script>
@if(!$fetch_value->isEmpty())
		<?php $i=0;?>
	@foreach($fetch_value as $key=>$val)
		<?php $i++; ?>
		@if($val->option_type_product_form == 1)
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
				<label class="name_label">{{@$val->option_name}} @if($val->show_in_search == 1)<span>*</span>@endif</label>
				<select class="form_select @if($val->show_in_search == 1){{'required'}}@endif" name="soption[{{@$val->option_master_id}}]">
				<option value="">Select</option>
					@foreach($val->option_value as $op_val)
						<option value="{{@$op_val->option_detail_id}}">{{@$op_val->option_name}}</option>
					@endforeach
				</select>
				</div>
			</div>
		@endif
		@if($val->option_type_product_form == 2)
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
				<label class="name_label">{{@$val->option_name}} @if($val->show_in_search == 1)<span>*</span>@endif</label>
				<select class="chosen-select @if($val->show_in_search == 1){{'error_req'}}@endif" name="moption[{{@$val->option_master_id}}][]" data-placeholder="Choose {{@$val->option_name}}..." id="chosen" multiple>
				<option value="">Select</option>
					@foreach($val->option_value as $op_val)
						<option value="{{@$op_val->option_detail_id}}">{{@$op_val->option_name}}</option>
					@endforeach
				</select>
				</div>
			</div>
		@endif
		@if($val->option_type_product_form == 3)
			<div class="col-md-6 col-sm-6 col-xs-12">
				<label class="name_label">{{@$val->option_name}} @if($val->show_in_search == 1)<span>*</span>@endif</label>
				<div class="checkbox-group optval_chk"> 
					<input id="checkiz1" type="checkbox" name="check[{{@$val->option_master_id}}]" class="@if($val->show_in_search == 1){{'error_req_chk'}}@endif" value="{{@$val->option_value[0]->option_detail_id}}"> 
					<label for="checkiz1">
						<span class="check"></span>
						<span class="box"></span>
						<p class="ft_text"></p>{{@$val->option_value[0]->option_name}}
					</label>
				</div>
			</div>
		@endif
		@if(($i%2) == 0)
			<div class="clearfix"></div>
		@endif
	@endforeach
@endif