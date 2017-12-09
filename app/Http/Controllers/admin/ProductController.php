<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
		DB::enableQueryLog();
        $product = DB::table(TBL_PRODUCT)
			->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name',TBL_USER.'.first_name as fname',TBL_USER.'.last_name as lname')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')
			->leftJoin(TBL_USER,TBL_PRODUCT.'.user_id','=',TBL_USER.'.user_id')
			->where('cat_des_1.language_id',1)
			->where('cat_des_2.language_id',1)
			->where('cat1.category_lavel',1)
			->where('cat2.category_lavel',2);
		if(session()->get('seller_name'))$request->request->add(['keyword' => session()->get('seller_name')]);
		if(@$request->all()){
			//request back from usermanagement->sellers->view products 			
			if(@$request->status){
				if($request->status == 3){
					$status = 0;
				}else{
					$status = $request->status;
				}
				$product = $product->where(TBL_PRODUCT.'.product_status',$status);
			}
			if(@$request->keyword){
				$product = $product->where(function($where) use ($request){
					      $where->where(TBL_PRODUCT.'.product_title','like','%'.$request->keyword.'%')
						  ->orwhere(TBL_PRODUCT.'.product_description','like','%'.$request->keyword.'%')
						  ->orwhere(TBL_PRODUCT.'.product_price',$request->keyword)
						  ->orwhere(DB::raw('CONCAT(first_name," " ,last_name)'),$request->keyword);
				});
			}
			if(@$request->category && $request->sub_cat == "")
			{
				$product = $product->where('cat_des_1.category_master_id',$request->category);
			}
			if(@$request->sub_cat && @$request->category)
			{
				$product = $product->where(function($where) use ($request){
					$where->where('cat_des_1.category_master_id',$request->category)
					->where('cat_des_2.category_master_id',$request->sub_cat);
				});
			}
			$product = $product->groupBy(TBL_PRODUCT.'.product_id')->orderBy(TBL_PRODUCT.'.product_id', 'DESC')->paginate(25);
			$fetch_sub_cat = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
				->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
				->where(TBL_CATEGORY_MASTER.'.parent_id',$request->category)
				->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
				->get();
		}
		else
		{
			$product = $product->groupBy(TBL_PRODUCT.'.product_id')->orderBy(TBL_PRODUCT.'.product_id', 'DESC')->paginate(25);
		}
		$query = DB::getQueryLog();
		//echo '<pre>'; 
		//print_r($query); 
		//echo "<pre>";print_r($product);die;
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
		->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
		->where(TBL_CATEGORY_MASTER.'.parent_id',0)->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
		->where(TBL_CATEGORY_MASTER.'.category_status','<>',3)
		->get();
		$data = ['product'=>$product,'get_parent'=>$fetch_category,'post_data'=>$request->all(),'sub_cat'=>@$fetch_sub_cat];
		return view('admin.product_list',$data);
    }
	public function product_details($id){
		$product = DB::table(TBL_PRODUCT);
		$product = $product->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name',TBL_USER.'.first_name',TBL_USER.'.last_name',TBL_USER.'.email',TBL_USER.'.phone')
		->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
		->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
		->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
		->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')
		->leftJoin(TBL_USER,TBL_PRODUCT.'.user_id','=',TBL_USER.'.user_id')
		->where('cat_des_1.language_id',1)
		->where('cat_des_2.language_id',1)
		->where('cat1.category_lavel',1)
		->where('cat2.category_lavel',2)
		->where(TBL_PRODUCT.'.product_id',$id)->first();
		$query = DB::getQueryLog();
		$product_image = DB::table(TBL_PRODUCT_TO_IMAGE)->where('product_id',$id)->get();
		
		
		$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
			->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
			->where(TBL_PRODUCT_OPTION_MASTER.'.category_id',$product->sub_cat)
			->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
			->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',0)
			->get();
			foreach($fetch_value as $key=>$val)
			{
				$fetch_value[$key]->option_value =  DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name',TBL_PRODUCT_OPTION_DETAIL.'.option_detail_id')
				->Join(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
				//->where(TBL_PRODUCT_OPTION_MASTER.'.category_id',$id)
				->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
				->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$val->option_master_id)
				->get();
			}
			$option_value_selected = DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->where('product_id',$id)->get();
		
		
		
		//echo '<pre>'; print_r($fetch_value);die; 
		//echo "<pre>";print_r($product_image);die;
		$data = ['product'=>$product,'product_image'=>$product_image,'fetch_value'=>@$fetch_value,'select_value'=>$option_value_selected];
		return view('admin.product_details',$data);
	}
	public function product_status($id){
		$product = DB::table(TBL_PRODUCT)
					->where('product_id',$id)
					->first();
		if($product->product_status == 2){
			$update = array('product_status'=>1);
		}
		else{
			$update = array('product_status'=>2);
		}
		DB::table(TBL_PRODUCT)->where('product_id',$id)->update($update);
		session()->flash('success','Product status change successfully');
		return redirect('admin-product-list');
	}
	public function product_option_list(Request $request){
		$data = array();		
		  if(@session()->get('category_id_from_edit_option') && @session()->get('subcategory_id_from_edit_option')){			
			$request->request->add(['category' =>session()->get('category_id_from_edit_option'),'sub_cat'=>session()->get('subcategory_id_from_edit_option')]);
		   }
			//set session for back from edit page
			session()->put('category_id',$request->category);
			session()->put('sub_cat',$request->sub_cat);
		if(@$request->all() && (@$request->category || @$request->sub_cat)){	
			$fetch_option = DB::table(TBL_PRODUCT_OPTION_MASTER);		
			$fetch = $fetch_option->select(TBL_PRODUCT_OPTION_MASTER.'.*','sub_category.category_name as cat_name','category.category_name as sub_cat_name',TBL_PRODUCT_OPTION_DETAIL.'.option_name','sub_category.category_master_id as cat_id','category.category_master_id as subcat_id')
			->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
			
			->leftJoin(TBL_CATEGORY_MASTER,TBL_PRODUCT_OPTION_MASTER.'.category_id','=',TBL_CATEGORY_MASTER.'.category_master_id')
			
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as category',TBL_CATEGORY_MASTER.'.category_master_id','=','category.category_master_id')
		
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as sub_category',TBL_CATEGORY_MASTER.'.parent_id','=','sub_category.category_master_id')
			
			->where('category.language_id',1)
			->where('sub_category.language_id',1)
			->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',0)
			->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
			->orderBy(TBL_PRODUCT_OPTION_MASTER.'.option_master_id','desc');
			if(@$request->category)
			{
				$fetch = $fetch_option->where('sub_category.category_master_id',$request->category);
			}
			if(@$request->sub_cat)
			{
				$fetch = $fetch_option->where('category.category_master_id',$request->sub_cat);
			}
			$fetch = $fetch_option->get();
			
			$fetch_sub_cat = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',$request->category)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
			->get();
			
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)->get();
			
			$language = DB::table(TBL_LANGUAGE)->get();
			$data = ['option_list'=>$fetch,'language'=>$language,'post'=>$request->all(),'category'=>$fetch_category,'sub_cat'=>@$fetch_sub_cat];
			
			return view('admin.product_option_list',$data);
		}
		else
		{
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)->get();
			$data['category']=$fetch_category;
			//echo "<pre>";print_r($fetch);die;
			return view('admin.product_option_list',$data);
		}
	}
	public function add_product_option(Request $request){
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
		->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
		->where(TBL_CATEGORY_MASTER.'.parent_id',0)->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)->get();
		
		$language = DB::table(TBL_LANGUAGE)->get();
		$post_data=$request->all();
		if(@$post_data)
		{
			$insert_product_option_master = array();
			$insert_product_option_master['category_id'] = $request->sub_cat;			
			$insert_product_option_master['option_type_product_form'] = $request->option_type_product_form;		
			$insert_product_option_master['show_in_search'] = $request->show_in_search;			
			$insert_product_option_master['option_type_search_form'] = $request->option_type_search_form;
			$insert_product_option_master['parent_id'] = 0;	
			$insert_id = DB::table(TBL_PRODUCT_OPTION_MASTER)->insertGetId($insert_product_option_master);
			if(@$insert_id){
			$insert_product_option_detail = array();
				////English
			$insert_product_option_detail['option_master_id'] = $insert_id;
			$insert_product_option_detail['language_id'] = 1;
			$insert_product_option_detail['option_name'] = (trim($request->product_option_name_e));
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->insertGetId($insert_product_option_detail);	
				//arabic				
			$insert_product_option_detail['option_master_id'] = $insert_id;
			$insert_product_option_detail['language_id'] = 2;
			$insert_product_option_detail['option_name'] = trim($request->product_option_name_a);
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->insertGetId($insert_product_option_detail);
			session()->flash('success','Option added successfully');
			return redirect('admin-product-option-list');			
			}
		}
		$data = ['category'=>$fetch_category,'language'=>$language];
		return view('admin.add_product_option',$data);
	}
	public function edit_product_option(Request $request,$id){
		if(@$id){
		$post_data=$request->all();
		if(@$post_data){
			$update_product_option_master = array();
			$update_product_option_master['category_id'] = $request->sub_cat;			
			$update_product_option_master['option_type_product_form'] = $request->option_type_product_form;		
			$update_product_option_master['show_in_search'] = $request->show_in_search;			
			$update_product_option_master['option_type_search_form'] = $request->option_type_search_form;
			$update_product_option_master['parent_id'] = 0;	
			
			DB::table(TBL_PRODUCT_OPTION_MASTER)->where('option_master_id',$id)->update($update_product_option_master);
			//Insert English
			$insert_product_option_detail = array();	
			$insert_product_option_detail['option_name'] =(trim($request->product_option_name_e));
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->where('option_master_id',$id)->where('language_id',1)->update($insert_product_option_detail);	
			//Insert arabic
			$insert_product_option_detail['option_name'] = trim($request->product_option_name_a);
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->where('option_master_id',$id)->where('language_id',2)->update($insert_product_option_detail);
			session()->flash('success','Option edited successfully.');
			session()->flash('category_id_from_edit_option',$request->category);	
			session()->flash('subcategory_id_from_edit_option',$request->sub_cat);
			//return redirect()->route('admin-product-option-list', ['user'=>'fgh']);
			return redirect('admin-product-option-list');
			}
			$category = DB::table(TBL_CATEGORY_MASTER)
			->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
			->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)	
			->get();
					
			$product_option_data = DB::table(TBL_PRODUCT_OPTION_MASTER)->where('option_master_id',$id)->first();		
			$sub_category_details=DB::table(TBL_CATEGORY_MASTER)->where('category_master_id',$product_option_data->category_id)->first();
			$category_id=$sub_category_details->parent_id;						
			$product_option_details_in_english = DB::table(TBL_PRODUCT_OPTION_DETAIL)->where('option_master_id',$id)->where('language_id',1)->first();
			$product_option_details_in_arabic = DB::table(TBL_PRODUCT_OPTION_DETAIL)->where('option_master_id',$id)->where('language_id',2)	->first();
								 
			$product_option_details=array(
			'english'=>$product_option_details_in_english->option_name,
			'arabic'=>$product_option_details_in_arabic->option_name
			);						
			$language = DB::table(TBL_LANGUAGE)->get();
			$data = [	'category'=>$category,
				'product_option_id'=>$id,
				'language'=>$language,
				'category_id'=>$category_id,
				'sub_category_id'=>$product_option_data->category_id,
				'product_option_data'=>$product_option_data,'product_option_details'=>$product_option_details];
			return view('admin.edit_product_option',$data);		
		}
		
	}
	public function option_value(Request $request){
		//echo $request->option_id;die;
		//$responce = array('msg'=>$request->option_id);
		$fetch_name =  DB::table(TBL_PRODUCT_OPTION_MASTER)
							->select(TBL_PRODUCT_OPTION_DETAIL.'.option_name')
							->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
							->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
							->where(TBL_PRODUCT_OPTION_MASTER.'.option_master_id',$request->option_id)
							->first();
		
		$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)
							->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
							->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
							->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$request->option_id)
							->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
							->get();
		$html = '';
		$html.='<div class="table-responsive" data-pattern="priority-columns">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Option Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
							if(!empty($fetch_value))
							{
								foreach($fetch_value as $row)
								{
									$html.='<tr>
										<td>'.$row->option_name.'</td>
										<td><a href="javascript:void(0);" class="edit_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
										<a href="javascript:void(0);" class="delete_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-trash delet" aria-hidden="true"></i></a>
										</td>
									</tr>';
								}
							}
							else
							{
								$html.='<tr><td colspan="2">No Record Found</td></tr>';
							}
						$html.='</tbody>
					</div>
				</div>';
		$responce = array('table'=>$html,'opt_name'=>$fetch_name->option_name);
		echo json_encode($responce);
	}
	public function add_option_value(Request $request){
		if(@$request->all())
		{
			$pro_duc_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->where('option_master_id',$request->option_id)->first();
			$insert = array();
			$insert['category_id'] = $pro_duc_value->category_id;
			$insert['option_type_product_form'] = $pro_duc_value->option_type_product_form;
			$insert['show_in_search'] = $pro_duc_value->show_in_search;
			$insert['option_type_search_form'] = $pro_duc_value->option_type_search_form;
			$insert['parent_id'] = $request->option_id;
			$ins_value_id = DB::table(TBL_PRODUCT_OPTION_MASTER)->insertGetId($insert);
			//English Insert
			$insert_english = array();
			$insert_english['option_master_id'] = $ins_value_id;
			$insert_english['language_id'] = 1;
			$insert_english['option_name'] = $request->option_value_e;
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->insert($insert_english);
			//Arabic Insert
			$insert_arabic = array();
			$insert_arabic['option_master_id'] = $ins_value_id;
			$insert_arabic['language_id'] = 2;
			$insert_arabic['option_name'] = $request->option_value_a;
			DB::table(TBL_PRODUCT_OPTION_DETAIL)->insert($insert_arabic);
			
			//List Of all Value
			$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
			->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
			->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$request->option_id)
			->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
			->get();
			$html = '';
			$html.='<div class="table-responsive" data-pattern="priority-columns">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Option Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
							if(!empty($fetch_value))
							{
								foreach($fetch_value as $row)
								{
									$html.='<tr>
										<td>'.$row->option_name.'</td>
										<td><a href="javascript:void(0);" class="edit_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
										<a href="javascript:void(0);" class="delete_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-trash delet" aria-hidden="true"></i></a>
										</td>
									</tr>';
								}
							}
							else
							{
								$html.='<tr><td colspan="2">No Record Found</td></tr>';
							}
						$html.='</tbody>
					</div>
				</div>';
			$responce = array('table'=>$html,'success'=>'Product option value add successfully');
			echo json_encode($responce);	
		}
	}
	public function update_option_value(Request $request){
		if(@$request->all()){
			$pro_duc_value = DB::table(TBL_PRODUCT_OPTION_DETAIL)
								->where('option_master_id',$request->option_id)
								->get();
			$english_id = $pro_duc_value[0]->option_detail_id;
			$arabic_id = $pro_duc_value[1]->option_detail_id;
			//English update
			$insert_english = array();
			$insert_english['option_name'] = $request->option_value_e;
				DB::table(TBL_PRODUCT_OPTION_DETAIL)
					->where('option_detail_id',$english_id)
					->update($insert_english);
			//Arabic update
			$insert_arabic = array();
			$insert_arabic['option_name'] = $request->option_value_a;
					DB::table(TBL_PRODUCT_OPTION_DETAIL)
					->where('option_detail_id',$arabic_id)
					->update($insert_arabic);
			
			//List Of all Value
			$pro_master_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->where('option_master_id',$request->option_id)->first();
			$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
			->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
			->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$pro_master_value->parent_id)
			->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
			->get();
			$html = '';
			$html.='<div class="table-responsive" data-pattern="priority-columns">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Option Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
							if(!empty($fetch_value))
							{
								foreach($fetch_value as $row)
								{
									$html.='<tr>
										<td>'.$row->option_name.'</td>
										<td><a href="javascript:void(0);" class="edit_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
										<a href="javascript:void(0);" class="delete_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-trash delet" aria-hidden="true"></i></a>
										</td>
									</tr>';
								}
							}
							else
							{
								$html.='<tr><td colspan="2">No Record Found</td></tr>';
							}
						$html.='</tbody>
					</div>
				</div>';
			$responce = array('table'=>$html,'success'=>'Product Option value update successfully');
			echo json_encode($responce);	
		}
	}
	public function edit_option_value(Request $request){
		$fetch = DB::table(TBL_PRODUCT_OPTION_DETAIL)
					->where('option_master_id',$request->option_id)
					->get();
		$responce = array('value_en'=>$fetch[0]->option_name,'value_ar'=>$fetch[1]->option_name);
		echo json_encode($responce);
	}
	public function delete_option_value(Request $request){
		$pro_master_value = DB::table(TBL_PRODUCT_OPTION_MASTER)
							->where('option_master_id',$request->option_id)
							->first();
		$pro_duc_value = DB::table(TBL_PRODUCT_OPTION_DETAIL)
							->where('option_master_id',$request->option_id)
							->get();
		//$english_id = $pro_duc_value[0]->option_detail_id;
		//$arabic_id = $pro_duc_value[1]->option_detail_id;
						DB::table(TBL_PRODUCT_OPTION_MASTER)
							->where('option_master_id',$request->option_id)
							->delete();
			DB::table(TBL_PRODUCT_OPTION_DETAIL)
				->where('option_master_id',$request->option_id)
				->delete();
		
		//List Of all Value
			$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)
							->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
							->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
							->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$pro_master_value->parent_id)
							->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
							->get();
			$html = '';
			$html.='<div class="table-responsive" data-pattern="priority-columns">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Option Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>';
							if(!empty($fetch_value))
							{
								foreach($fetch_value as $row)
								{
									$html.='<tr>
										<td>'.$row->option_name.'</td>
										<td><a href="javascript:void(0);" class="edit_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-pencil-square-o delet" aria-hidden="true"></i></a>
										<a href="javascript:void(0);" class="delete_val" data-id = "'.$row->option_master_id.'" title="Edit"> <i class="fa fa-trash delet" aria-hidden="true"></i></a>
										</td>
									</tr>';
								}
							}
							else
							{
								$html.='<tr><td colspan="2">No Record Found</td></tr>';
							}
						$html.='</tbody>
					</div>
				</div>';
			$responce = array('table'=>$html,'success'=>'Product option value deleted successfully','option_val_id'=>$pro_master_value->parent_id);
			echo json_encode($responce);	
	}
	public function product_option_delete(Request $request,$id){
			DB::table(TBL_PRODUCT_OPTION_MASTER)
			->where('option_master_id',$id)
			->delete();
			session()->flash('success','Option added successfully');
			return redirect('admin-product-option-list');
	}
	public function seller_products(Request $request,$id){
			$sellerFullName=DB::table(TBL_USER)				
				->where('user_id',$id)
				->first();
				$varSellerFullName=$sellerFullName->first_name.' '.$sellerFullName->last_name;
				session()->flash('seller_name',$varSellerFullName);
				return redirect('admin-product-list');
	}
	public function admin_multi_product_change_status(Request $request){		
			if(@$request->action=='Approve' && @$request->product){
				$arrOfProduct=$request->product;					    
				foreach($arrOfProduct as $val){					
				$unapprovedProduct=DB::table(TBL_PRODUCT)
								->where('product_id',$val)
								->where('product_status',0)
								->first();
					if(count($unapprovedProduct)){
						//seller get a approved mail for his product
						
						//update the product status 0 to 1 
								DB::table(TBL_PRODUCT)
									->where('product_id',$val)
									->update(array('product_status'=>1));
									
					}				
				}		
			   session()->flash('success','Product status change successfully.');
		       return redirect('admin-product-list');
			}elseif(@$request->action=='Active' && @$request->product){				
				$arrOfProduct=$request->product;
				foreach($arrOfProduct as $productId){
					$inactiveProduct=DB::table(TBL_PRODUCT)
								->where('product_id',$productId)
								->where('product_status',2)
								->first();
					//only inactive product gets active
					if(count($inactiveProduct)){
							DB::table(TBL_PRODUCT)
								->where('product_id',$productId)
								->update(array('product_status'=>1));
					}
				}		
			   session()->flash('success','Product status change successfully.');
		       return redirect('admin-product-list');
			}elseif(@$request->action=='Inactive' && @$request->product){				
				$arrOfProduct=$request->product;
				foreach($arrOfProduct as $productId){
					$activeProduct=DB::table(TBL_PRODUCT)
								->where('product_id',$productId)
								->where('product_status',1)
								->first();
					//only active product gets inactive
					if(count($activeProduct)){
							DB::table(TBL_PRODUCT)
								->where('product_id',$productId)
								->update(array('product_status'=>2));
					}
				}
				session()->flash('success','Product status change successfully.');
		        return redirect('admin-product-list');
			}else{
			return redirect('admin-product-list');
			}
	}
	public function admin_product_approve(Request $request,$id){		
		 $unApprovedProductId=$id;		 
		 $unapprovedProduct=DB::table(TBL_PRODUCT)
								->where('product_id',$unApprovedProductId)
								->where('product_status',0)
								->first();
		 if(count($unapprovedProduct)){
			 //seller get a approved mail for his product
		      
			  DB::connection()->enableQueryLog();
			  //update the product status 0 to 1 
				DB::table(TBL_PRODUCT)
					->where('product_id',$unApprovedProductId)
					->update(array('product_status'=>1));
			session()->flash('success','Product status has been changed.');
			return redirect('admin-product-list');		
		}				
						
	}
}
