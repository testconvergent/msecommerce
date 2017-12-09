<?php
namespace App\Http\Controllers;
use DB;
use App;
use Image;
use File;
use App\Image_lib\Image_libary;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index(Request $request){
		if(session()->get('user_type') != 2){
			return redirect('dashboard');
		}
		if(App::getLocale()=='en'){
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
			->get();
		}
		if(App::getLocale()=='ar')
		{
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
			->get();
		}
		if(@$request->all()){			
			$validation = array();
			$validation['product_in_stock'] = 'required';
			$validation['category'] = 'required';
			$validation['sub_cat'] = 'required';
			$validation['product_quentity'] = 'required';
			$validation['product_price'] = 'required';
			$validation['product_title'] = 'required';
			$validation['product_description'] = 'required';
			$this->validate($request,$validation);
			
			$insert = array();
			$insert['user_id'] = session()->get('user_id');
			$insert['product_title'] = $request->product_title;
			$insert['product_price'] = $request->product_price;
			$insert['product_quentity'] = $request->product_quentity;
			$insert['product_description'] = $request->product_description;
			$insert['shipping_charge'] = $request->shipping_charge;
			$insert['product_offer_price'] = $request->product_offer_price;
			$insert['offer_start_date'] = $request->offer_start_date;
			$insert['offer_end_date'] = $request->offer_end_date;
			$insert['product_in_stock'] = $request->product_in_stock;
			$insert['product_youtube'] = $request->product_youtube;
			$insert['product_status'] = 0;
			
			$product_id = DB::table(TBL_PRODUCT)->insertGetId($insert);
			
			$search  = array('!','/','@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
			$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');			
			$name = trim($request['product_title']);
			$len=strlen($name);
			$resource_slug=str_replace($search, $replace, $name);
			$resource_slug=str_replace(' ','-',$resource_slug);
			for($i=0;$i<=$len;$i++)
			{
				$resource_slug=str_replace('--','-',$resource_slug);
				$resource_slug=strtolower($resource_slug);
			}
			$slug_array = array();
			$slug_array['product_slug'] = $resource_slug;
			$check = DB::table(TBL_PRODUCT)->where('product_slug',$slug_array)->get();
			if(count($check)>0){
				$resource_slug=$resource_slug."-".$product_id;
			}else{
				$resource_slug=$resource_slug;
			}
			$update_slug=array();
			$update_slug['product_slug']=$resource_slug;
			DB::table(TBL_PRODUCT)->where('product_id',$product_id)->update($update_slug);
			
			/*Category Insert*/
			$inser_cat = array();
			$inser_cat['product_id'] = $product_id;
			$inser_cat['category_id'] = $request->category;
			$inser_cat['category_lavel'] = 1;
			DB::table(TBL_PRODUCT_TO_CATEGORY)->insert($inser_cat);
			$inser_subcat = array();
			$inser_subcat['product_id'] = $product_id;
			$inser_subcat['category_id'] = $request->sub_cat;
			$inser_subcat['category_lavel'] = 2;
			DB::table(TBL_PRODUCT_TO_CATEGORY)->insert($inser_subcat);
			/*Category Insert*/
			
			/*Product Option Value Insert*/
			if(@$request->soption || @$request->moption || @$request->check)
			{
				if(@$request->soption)
				{
					foreach($request->soption as $key=>$option1)
					{
						//echo "<pre>";print_r($key);die;
						$insert_option1 = array();
						$insert_option1['product_id'] = $product_id;
						$insert_option1['option_master_id'] = $key;
						$insert_option1['option_detail_id'] = $option1;
						DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option1);
					}
				}
				if(@$request->moption)
				{
					foreach($request->moption as $key=>$option2)
					{
						foreach($request->moption[$key] as $val)
						{
							$insert_option2 = array();
							$insert_option2['product_id'] = $product_id;
							$insert_option2['option_master_id'] = $key;
							$insert_option2['option_detail_id'] = $val;
							DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option2);
						}
					}
				}
				if(@$request->check){
					foreach($request->check as $key=>$option3){
						//echo "<pre>";print_r($key);die;
						$insert_option3 = array();
						$insert_option3['product_id'] = $product_id;
						$insert_option3['option_master_id'] = $key;
						$insert_option3['option_detail_id'] = $option3;
						DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option3);
					}
				}
			}
			/*Product Option Value Insert*/
			
			/*Image Insert*/
			if($request->hasFile('product_image')) {
			$remove=explode(',',$request->change_image);
			$files = $request->product_image;
			//echo "<pre>";print_r($files);die;
			//$files = $_FILES['product_image']['name'];
			//echo "<pre>";print_r($_FILES);die;
				foreach($files as $key=>$file){
					if($remove[$key]!='cancel' && $file!='')
					{
						$filename = time().".".$file->getClientOriginalName();
						$file->storeAs('public/product_image',$filename);
						$location = base_path('storage/app/public/product_image/thumb');
						$location = $location.'/'.$filename;
						Image::make($file->getRealPath())->resize(205, 240)->save($location,80);
						/* $_FILES['product_image1']['name'] = $_FILES['product_image']['name'][$key];
						$_FILES['product_image1']['tmp_name'] = $_FILES['product_image']['tmp_name'][$key];
						//$file_name = $_FILES['product_image']['name'];
						//echo $_FILES['product_image1']['name'];
						$type=explode('.',$_FILES['product_image1']['name']);
						
						$type1 = $type[0];
						$type2 = $type[1];
			
						//echo $type1;die;
						$width = 205;
						$height = 240;
						$file_name=time().'-'.rand(10000,99999).'.'.$type2;
						//echo $type1;die;
						$file_loc = $_FILES['product_image1']['tmp_name'];
						$uploade_path="storage/app/public/product_image/";
						$resize_path="storage/app/public/product_image/thumb/";
						Image_libary::get_image($file_name,$type2,$width,$height,$file_loc,$uploade_path,$resize_path); */
						$insert_image = array();
						$insert_image['product_id'] = $product_id;
						$insert_image['product_image'] = $filename;
						DB::table(TBL_PRODUCT_TO_IMAGE)->insert($insert_image);
					}
				}
				//die;
			}
			/*Image Insert*/
			session()->flash('success','Product added successfully');
			return redirect('add-product');
		}
		//echo "<pre>";print_r($fetch_category);die;
		$data = ['category'=>$fetch_category];
		if(App::getLocale()=='en')
		{
			return view('english.add_product',$data);
		}
		if(App::getLocale()=='ar')
		{
			return view('arabic.add_product',$data);
		}
    }
	public function sub_category(Request $request){
		$category = $request->category;
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
		->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
		->where(TBL_CATEGORY_MASTER.'.parent_id',$category)
		->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
		->get();
		$msg="";
		$msg.="<option value=''>فرعية</option>";
		foreach($fetch_category as $cat)
		{
			$msg.="<option value=".$cat->category_id.">".$cat->cat_name."</option>";
		}
		echo $msg; 
	}
	public function my_product(){
		if(session()->get('user_type') != 2)
		{
			return redirect('dashboard');
		}
		$product = DB::table(TBL_PRODUCT)->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name',TBL_PRODUCT_TO_IMAGE.'.product_image')
		->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
		->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
		->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
		->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')
		->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
		->where('cat_des_1.language_id',1)
		->where('cat_des_2.language_id',1)
		->where('cat1.category_lavel',1)
		->where('cat2.category_lavel',2)
		->where(TBL_PRODUCT.'.user_id',session()->get('user_id'))->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')->paginate(5);
		//echo "<pre>";print_r($product);die;
		$data = ['product'=>$product];
		if(App::getLocale()=='en')
		{
			return view('english.my_product',$data);
		}
		if(App::getLocale()=='ar')
		{
			return view('arabic.my_product',$data);
		}
	}
	public function edit_product(Request $request,$slug){
		$fetch_product = DB::table(TBL_PRODUCT)->where('product_slug',$slug)->first();
		if(!empty($fetch_product->product_slug) && $fetch_product->user_id == session()->get('user_id'))
		{
			if(App::getLocale()=='en')
			{
				$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
				->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
				->where(TBL_CATEGORY_MASTER.'.parent_id',0)
				->where(TBL_CATEGORY_MASTER.'.category_status',1)
				->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
				->get();
			}
			if(App::getLocale()=='ar')
			{
				$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
				->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
				->where(TBL_CATEGORY_MASTER.'.parent_id',0)
				->where(TBL_CATEGORY_MASTER.'.category_status',1)
				->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
				->get();
			}
			$product_id = $fetch_product->product_id;
			$product = DB::table(TBL_PRODUCT)->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat1.product_to_cat_id as pro_to_cat_id','cat2.product_to_cat_id as pro_to_subcat_id','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')
			->where('cat_des_1.language_id',1)
			->where('cat_des_2.language_id',1)
			->where('cat1.category_lavel',1)
			->where('cat2.category_lavel',2)
			->where(TBL_PRODUCT.'.user_id',session()->get('user_id'))
			->where(TBL_PRODUCT.'.product_id',$product_id)
			->first();
			$image = Db::table(TBL_PRODUCT_TO_IMAGE)->where('product_id',$product_id)->get();
			//echo "<pre>";print_r($product);die;
			if(App::getLocale()=='en')
			{
				$category = $product->parent_cat;
				$fetch_sub_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
				->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
				->where(TBL_CATEGORY_MASTER.'.parent_id',$category)
				->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
				->get();
			}
			if(App::getLocale()=='ar')
			{
				$category = $product->parent_cat;
				$fetch_sub_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
				->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
				->where(TBL_CATEGORY_MASTER.'.parent_id',$category)
				->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
				->get();
			}
			if(@$request->all())
			{
				//echo "Hii";die;
				$validation = array();
				$validation['product_in_stock'] = 'required';
				$validation['category'] = 'required';
				$validation['sub_cat'] = 'required';
				$validation['product_quentity'] = 'required';
				$validation['product_price'] = 'required';
				$validation['product_title'] = 'required';
				$validation['product_description'] = 'required';
				$this->validate($request,$validation);
				
				$insert = array();
				$insert['product_title'] = $request->product_title;
				$insert['product_price'] = $request->product_price;
				$insert['product_quentity'] = $request->product_quentity;
				$insert['product_description'] = $request->product_description;
				$insert['shipping_charge'] = $request->shipping_charge;
				$insert['product_offer_price'] = $request->product_offer_price;
				$insert['offer_start_date'] = $request->offer_start_date;
				$insert['offer_end_date'] = $request->offer_end_date;
				$insert['product_in_stock'] = $request->product_in_stock;
				$insert['product_youtube'] = $request->product_youtube;
				
				DB::table(TBL_PRODUCT)->where('product_id',$product_id)->update($insert);
				
				$search  = array('!', '@','/', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
				$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');			
				$name = trim($request['product_title']);
				$len=strlen($name);
				$resource_slug=str_replace($search, $replace, $name);
				$resource_slug=str_replace(' ','-',$resource_slug);
				for($i=0;$i<=$len;$i++)
				{
					$resource_slug=str_replace('--','-',$resource_slug);
					$resource_slug=strtolower($resource_slug);
				}
				$slug_array = array();
				$slug_array['product_slug'] = $resource_slug;
				$check = DB::table(TBL_PRODUCT)->where('product_slug',$slug_array)->where('product_id','!=',$product_id)->get();
				if(count($check)>0)
				{
					$resource_slug=$resource_slug."-".$product_id;
				}
				else
				{
					$resource_slug=$resource_slug;
				}
				$update_slug=array();
				$update_slug['product_slug']=$resource_slug;
				DB::table(TBL_PRODUCT)->where('product_id',$product_id)->update($update_slug);
				
				/*Category Insert*/
				$inser_cat = array();
				//$inser_cat['product_id'] = $product_id;
				$inser_cat['category_id'] = $request->category;
				//$inser_cat['category_lavel'] = 1;
				DB::table(TBL_PRODUCT_TO_CATEGORY)->where('product_to_cat_id',$product->pro_to_cat_id)->update($inser_cat);
				$inser_subcat = array();
				//$inser_subcat['product_id'] = $product_id;
				$inser_subcat['category_id'] = $request->sub_cat;
				//$inser_subcat['category_lavel'] = 2;
				DB::table(TBL_PRODUCT_TO_CATEGORY)->where('product_to_cat_id',$product->pro_to_subcat_id)->update($inser_subcat);
				/*Category Insert*/
				
				/*Product Option Value Insert*/
				if(@$request->soption || @$request->moption || @$request->check)
				{
					DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->where('product_id',$product_id)->delete();
					if(@$request->soption)
					{
						
						foreach($request->soption as $key=>$option1)
						{
							//echo "<pre>";print_r($key);die;
							$insert_option1 = array();
							$insert_option1['product_id'] = $product_id;
							$insert_option1['option_master_id'] = $key;
							$insert_option1['option_detail_id'] = $option1;
							DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option1);
						}
					}
					if(@$request->moption)
					{
						foreach($request->moption as $key=>$option2)
						{
							foreach($request->moption[$key] as $val)
							{
								$insert_option2 = array();
								$insert_option2['product_id'] = $product_id;
								$insert_option2['option_master_id'] = $key;
								$insert_option2['option_detail_id'] = $val;
								DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option2);
							}
						}
					}
					if(@$request->check)
					{
						
						foreach($request->check as $key=>$option3)
						{
							//echo "<pre>";print_r($key);die;
							$insert_option3 = array();
							$insert_option3['product_id'] = $product_id;
							$insert_option3['option_master_id'] = $key;
							$insert_option3['option_detail_id'] = $option3;
							DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->insert($insert_option3);
						}
					}
				}
				/*Product Option Value Insert*/
				
				
				
				/*Image Insert*/
				if($request->hasFile('product_image')) {
				$remove=explode(',',$request->change_image);
				$files = $request->product_image;
					//$files = $_FILES['product_image']['name'];
					foreach($files as $key=>$file){
						if($remove[$key]!='cancel' && $file!='')
						{
							$filename = time().".".$file->getClientOriginalName();
							$file->storeAs('public/product_image',$filename);
							$location = base_path('storage/app/public/product_image/thumb');
							$location = $location.'/'.$filename;
							Image::make($file->getRealPath())->resize(205, 240)->save($location,80);
							/* $_FILES['product_image1']['name'] = $_FILES['product_image']['name'][$key];
							$_FILES['product_image1']['tmp_name'] = $_FILES['product_image']['tmp_name'][$key];
							//$file_name = $_FILES['product_image']['name'];
							//echo $_FILES['product_image1']['name'];
							$type=explode('.',$_FILES['product_image1']['name']);
							
							$type1 = $type[0];
							$type2 = $type[1];
							//echo $type1;die;
							$width = 205;
							$height = 240;
							$file_name=time().'-'.rand(10000,99999).'.'.$type2;
							//echo $type1;die;
							$file_loc = $_FILES['product_image1']['tmp_name'];
							$uploade_path="storage/app/public/product_image/";
							$resize_path="storage/app/public/product_image/thumb/";
							Image_libary::get_image($file_name,$type2,$width,$height,$file_loc,$uploade_path,$resize_path); */
							$insert_image = array();
							$insert_image['product_id'] = $product_id;
							$insert_image['product_image'] = $filename;
							DB::table(TBL_PRODUCT_TO_IMAGE)->insert($insert_image);
						}
					}
				}
				/*Image Insert*/
				session()->flash('success','Product edited successfully');
				return redirect('edit-product/'.$slug);
			}
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
			$option_value_selected = DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->where('product_id',$product_id)->get();
			//echo "<pre>";print_r($fetch_value);die;
			$data = ['product'=>$product,'category'=>$fetch_category,'sub_category'=>$fetch_sub_category,'image'=>$image,'fetch_value'=>$fetch_value,'select_value'=>$option_value_selected];
			if(App::getLocale()=='en')
			{
				return view('english.edit_product',$data);
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.edit_product',$data);
			}
		}
		else
		{
			return redirect('dashboard');
		}
	}
	public function delete_image(Request $request,$id){
		//echo $id;die;
		$fetch_image = DB::table(TBL_PRODUCT_TO_IMAGE)->where('product_image_id',$id)->first();
		if(count($fetch_image)>0)
		{
			$fetch_product = DB::table(TBL_PRODUCT)->where('product_id',$fetch_image->product_id)->first();
			if(!empty($fetch_product->product_id) && $fetch_product->user_id == session()->get('user_id'))
			{
				DB::table(TBL_PRODUCT_TO_IMAGE)->where('product_image_id',$id)->delete();
				session()->flash('success','Product image deleted successfully');
				return redirect('edit-product/'.$fetch_product->product_slug);
			}else{
				return redirect('dashboard');
			}
		}else{
			session()->flash('error','You can not delete all image for this product.');
			return redirect('add-product');
		}
	
		$check = DB::table(TBL_PRODUCT)->where('product_id',$id)->first();
		if(count($check)>0 && $check->user_id == session()->get('user_id')){
			if($check->product_status == 1){
				$update = array();
				$update['product_status'] = 2;
			}elseif($check->product_status == 2)	{
				$update = array();
				$update['product_status'] = 1;
			}elseif($check->product_status == 0){
				return redirect('my-product');
			}
			DB::table(TBL_PRODUCT)->where('product_id',$id)->update($update);
			session()->flash('success','Product status changed successfully.');
			return redirect('my-product');
		}
		else
		{
			return redirect('my-product');
		}	
	}
	public function add_to_cart(Request $request){
		//$product_id = $request->product_id;
		$product = DB::table(TBL_PRODUCT)->where('product_id',$request->product_id)->where('product_status',1)->first();
		if(count($product)>0)
		{
			$fetch_cart_master = DB::table(TBL_CART_MASTER)->where('user_id',session()->get('user_id'))->first();
			/* if(@$product->shipping_charge)
			{
				$cart_total = ($product->product_price+$product->shipping_charge);
			}
			else
			{
				$cart_total = $product->product_price;
			} */
			$cart_total = $product->product_price;
			if(count($fetch_cart_master)>0)
			{
				$cart_master_update = array();
				if(@$request->product_qty)
				{
					$get_cart_details = DB::table(TBL_CART_DETAILS)->where('cart_master_id',$fetch_cart_master->cart_master_id)->where('product_id',$request->product_id)->first(); 
					
					$get_sub_total = ($fetch_cart_master->cart_sub_total-$get_cart_details->total_price);
					$cart_sub_total = $get_sub_total+($request->product_qty*$cart_total);
					
					$cart_master_update['cart_sub_total'] = $cart_sub_total;
					$cart_master_update['cart_total'] = $cart_sub_total;
					//$cart_master_update['cart_item_no'] = $fetch_cart_master->cart_item_no+1;
					DB::table(TBL_CART_MASTER)->where('cart_master_id',$fetch_cart_master->cart_master_id)->update($cart_master_update);
				}
				else
				{
					$cart_master_update['cart_sub_total'] = ($fetch_cart_master->cart_sub_total+$product->product_price);
					$cart_master_update['cart_total'] = ($fetch_cart_master->cart_total+$cart_total);
					$cart_master_update['cart_item_no'] = $fetch_cart_master->cart_item_no+1;
					DB::table(TBL_CART_MASTER)->where('cart_master_id',$fetch_cart_master->cart_master_id)->update($cart_master_update);
					$responce = array('cart_item'=>$cart_master_update['cart_item_no']);
					$insert_master = $fetch_cart_master->cart_master_id;
				}
			}
			else
			{
				$cart_master_insert = array();
				$cart_master_insert['user_id'] = session()->get('user_id');
				$cart_master_insert['cart_item_no'] = 1;
				$cart_master_insert['cart_sub_total'] = $product->product_price;
				$cart_master_insert['cart_total'] = $cart_total;
				$cart_master_insert['cart_date'] = time();
				$cart_master_insert['cart_id'] = session()->getId();
				$insert_master=DB::table(TBL_CART_MASTER)->insertGetId($cart_master_insert);
				$responce = array('cart_item'=>$cart_master_insert['cart_item_no']);
				
			}
			$fetch_cart_details = DB::table(TBL_CART_DETAILS)->where('product_id',$product->product_id)->first();
			if(count($fetch_cart_details)>0)
			{
				$cart_details_update = array();
				if(@$request->product_qty)
				{
					$cart_details_update['qty'] = $request->product_qty;
					$cart_details_update['total_price'] = ($request->product_qty*$product->product_price);
					DB::table(TBL_CART_DETAILS)->where('cart_details_id',$fetch_cart_details->cart_details_id)->update($cart_details_update);
					/* Cart Page ajax*/
					$get_cart = DB::table(TBL_CART_MASTER)->select(TBL_CART_MASTER.'.*',TBL_CART_DETAILS.'.*',TBL_PRODUCT.'.product_title',TBL_PRODUCT.'.product_slug',TBL_PRODUCT.'.product_quentity',TBL_PRODUCT_TO_IMAGE.'.product_image',TBL_USER.'.first_name',TBL_USER.'.last_name',TBL_USER.'.user_slug')
					->leftJoin(TBL_CART_DETAILS,TBL_CART_MASTER.'.cart_master_id','=',TBL_CART_DETAILS.'.cart_master_id')
					->leftJoin(TBL_PRODUCT,TBL_CART_DETAILS.'.product_id','=',TBL_PRODUCT.'.product_id')
					->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
					->leftJoin(TBL_USER,TBL_CART_DETAILS.'.seller_id','=',TBL_USER.'.user_id')
					->where(TBL_CART_MASTER.'.user_id',session()->get('user_id'))
					->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')
					->get();
					$returnHTML = view('ajax_page.cart')->with('cart_item', $get_cart)->render();
					//echo $returnHTML;
					$responce = array('cart_html'=>$returnHTML);
				}
				else
				{
					$cart_details_update['qty'] = $fetch_cart_details->qty+1;
					$cart_details_update['total_price'] = $fetch_cart_details->total_price+$product->product_price;
					DB::table(TBL_CART_DETAILS)->where('cart_details_id',$fetch_cart_details->cart_details_id)->update($cart_details_update);
				}
				
			}
			else
			{
				$cart_details_insert = array();
				$cart_details_insert['seller_id'] = $product->user_id;
				$cart_details_insert['cart_master_id'] = $insert_master;
				$cart_details_insert['product_id'] = $product->product_id;
				$cart_details_insert['qty'] = 1;
				$cart_details_insert['unit_price'] = $product->product_price;
				$cart_details_insert['total_price'] = $product->product_price;
				DB::table(TBL_CART_DETAILS)->insert($cart_details_insert);
			}
		}
		//$responce = array($responce);
		echo json_encode($responce);
	}
	public function fetch_option(Request $request){
		$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
		->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
		->where(TBL_PRODUCT_OPTION_MASTER.'.category_id',$request->category_id)
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
		$returnHTML = view('ajax_page.product_add_value')->with('fetch_value', $fetch_value)->render();
		//echo $returnHTML;
		$responce = array('option_html'=>$returnHTML);
		echo json_encode($responce);
		//echo "<pre>";
		//print_r($fetch_value);
	}
	public function product_details($slug){
		$data = array();
		$fetch_product = DB::table(TBL_PRODUCT)->where('product_slug',$slug)->first();
		if(@$fetch_product)
		{
			$product_id = $fetch_product->product_id;
			$product = DB::table(TBL_PRODUCT)
			->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat1.product_to_cat_id as pro_to_cat_id','cat2.product_to_cat_id as pro_to_subcat_id','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name','cat_des_1.category_master_id as parent_cat_id','cat_des_2.category_master_id as sub_cat_id')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
			->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')							
			->where('cat_des_1.language_id',1)
			->where('cat_des_2.language_id',1)
			->where('cat1.category_lavel',1)
			->where('cat2.category_lavel',2)
			->where(TBL_PRODUCT.'.product_id',$product_id)
			->first();
			$fetch_value = DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name')
			->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
			->where(TBL_PRODUCT_OPTION_MASTER.'.category_id',$product->sub_cat)
			->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
			->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',0)
			->get();
			foreach($fetch_value as $key=>$val){
				$fetch_value[$key]->option_value =  DB::table(TBL_PRODUCT_OPTION_MASTER)->select(TBL_PRODUCT_OPTION_MASTER.'.*',TBL_PRODUCT_OPTION_DETAIL.'.option_name',TBL_PRODUCT_OPTION_DETAIL.'.option_detail_id')
				->Join(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
				//->where(TBL_PRODUCT_OPTION_MASTER.'.category_id',$id)
				->where(TBL_PRODUCT_OPTION_DETAIL.'.language_id',1)
				->where(TBL_PRODUCT_OPTION_MASTER.'.parent_id',$val->option_master_id)
				->get();
			}
			$option_value_selected = DB::table(TBL_PRODUCT_TO_PRODUCT_OPTION)->where(TBL_PRODUCT_TO_PRODUCT_OPTION.'.product_id',$product_id)->get();
			$image = Db::table(TBL_PRODUCT_TO_IMAGE)->where('product_id',$product_id)->get();
			$product_review = DB::table(TBL_PRODUCT_REVIEW)->select(TBL_PRODUCT_REVIEW.'.*',TBL_USER.'.first_name',TBL_USER.'.last_name')->leftJoin(TBL_USER,TBL_PRODUCT_REVIEW.'.user_id','=',TBL_USER.'.user_id')->where('product_id',$product_id)->get();
			
			
			$similer_product = DB::table(TBL_PRODUCT)->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat2.category_id as sub_cat',TBL_PRODUCT_TO_IMAGE.'.product_image')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
			->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
			->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
			->where('cat1.category_lavel',1)
			->where('cat2.category_lavel',2)
			->where('cat2.category_id',$product->sub_cat)
			->where(TBL_PRODUCT.'.product_id','!=',$product_id)
			->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')->where(TBL_PRODUCT.'.product_status',1)->get();
			//echo "<pre>";print_r($product_review);die;
			$product->cat_name_slag=$this->getCatSlugName($product->parent_cat_id);
			$product->sub_cat_name_slag=$this->getCatSlugName($product->sub_cat_id);	
			$data['product'] = $product;
			$data['fetch_value'] = $fetch_value;
			$data['select_value'] = $option_value_selected;
			$data['review'] = $product_review;
			$data['similer_product'] = $similer_product;
			$data['base_url']=url('');
			$data['cat_bread_cum']=url('search/'.$product->cat_name_slag);
			$data['sub_cat_bread_cum']=url('search/'.$product->cat_name_slag.'/'.$product->sub_cat_name_slag);			
				
			$data['image'] = $image;			
			if(App::getLocale()=='en')
			{
				return view('english.product_details',$data);
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.product_details',$data);
			}
		}
	}
	public function getCatSlugName($cat_id){
		$catDetails=DB::table(TBL_CATEGORY_MASTER)
						->where('category_master_id',$cat_id)
						->first();
		return $catDetails->category_slug;
	}
	public function product_review(Request $request){
		$insert = array();
		$product = DB::table(TBL_PRODUCT)->where('product_id',$request->product_id)->first();
		$insert['product_id'] = $request->product_id;
		$insert['review_point'] = $request->rating;
		$insert['review_title'] = $request->review_title;
		$insert['review_desc'] = nl2br($request->review_desc);
		$insert['review_date'] = date('Y-m-d');
		$insert['user_id'] = session()->get('user_id');
		DB::table(TBL_PRODUCT_REVIEW)->insert($insert);
		return redirect('product/'.$product->product_slug);
	}
}
