<?php
namespace App\Http\Controllers;
use DB;
use App;
use Image;
use File;
use App\Image_lib\Image_libary;
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function index(){
		if(session()->get('user_type') == 3)
		{
			$user = DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->first();
			$user_address = DB::table(TBL_ADDRESS_BOOK)->where('user_id',session()->get('user_id'))->where('default_address',1)->first();
			$data = ['get'=>$user,'user_address'=>$user_address];
			if(App::getLocale()=='en')
			{
				return view('english.buyer_dashboard',$data);
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.buyer_dashboard',$data);
			}
		}
		if(session()->get('user_type') == 2)
		{
			if(App::getLocale()=='en')
			{
				return view('english.seller_dashboard');
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.seller_dashboard');
			}
		}
		if(session()->get('user_type') == "")
		{
			return redirect('login');
		}
    }
	public function change_password(Request $request){
		$post_data = $request->all();
		//echo session()->get('admin_id');die;
		if(@$post_data){
			$this->validate($request,[
			'curr_password'=>'required',
			'new_password'=>'required',
			'conf_password'=>'required',
			]);
			$request_curr_password 	= $request->curr_password;
			$request_new_password 	= $request->new_password;
			$request_conf_password 	= $request->conf_password;
			$curr_password = md5($request_curr_password);
			$user_data =DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->first();
			if($user_data->password==$curr_password)
			{
				if($request_new_password == $request_conf_password)
				{
					$update['password'] = md5($request_new_password);
					DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->update($update);
					session()->flash('success','Password has been changed successfully.'); 
					return redirect('change-password');
				}
				else{
					session()->flash('error','Confirm password does not match.'); 
					return redirect('change-password');
				}
			}
			else{
				session()->flash('error','Current password does not match.'); 
				return redirect('change-password');
			}
		}
		if(App::getLocale()=='en')return view('english.change_password');
		if(App::getLocale()=='ar')return view('arabic.change_password');
		
	}
	public function edit_profile(){
		//echo session()->get('user_type') ;die;
		//seller edit profile
		if(session()->get('user_type') == 2){
			$user = DB::table(TBL_USER)
					->where('user_id',session()->get('user_id'))
					->first();
			$country = DB::table(TBL_COUNTRY)
						->select(TBL_COUNTRY.'.country_id',TBL_COUNTRY.'.country_name')
						->get();
			$state = DB::table(TBL_STATE)
					->where('country_id',$user->country)
					->get();
			$data = ['get'=>$user,'country'=>$country,'state'=>$state];
			if(App::getLocale()=='en')
			{
				return view('english.seller_edit_profile',$data);
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.seller_edit_profile',$data);
			}
		}
		//buyer edit profile
		if(session()->get('user_type') == 3)
		{
			$user = DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->where('user_type',3)->first();
			$country = DB::table(TBL_COUNTRY)->select(TBL_COUNTRY.'.country_id',TBL_COUNTRY.'.country_name')->get();
			$state = DB::table(TBL_STATE)->where('country_id',$user->country)->get();
			$data = ['get'=>$user,'country'=>$country,'state'=>$state];
			if(App::getLocale()=='en')
			{
				return view('english.buyer_edit_profile',$data);
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.buyer_edit_profile',$data);
			}
		}
		if(session()->get('user_id') == "")
		{
			return redirect('login');
		}
	}
	public function seller_edit(Request $request){
		if(@$request->all()){	
			$validation = array();
			$validation['first_name'] = 'required';
			$validation['last_name'] = 'required';
			$validation['industry_type'] = 'required';
			//$validation['company_name'] = 'required';
			$validation['phone'] = 'required';
			$validation['website'] = 'required';
			$validation['location'] = 'required';
			$validation['address'] = 'required';			
			$validation['area'] = 'required';
			$validation['street'] = 'required';
			//$validation['avenue'] = 'required';
			$validation['block'] = 'required';
			$validation['house_building'] = 'required';
			$validation['building_floor'] = 'nullable|numeric';
			$validation['pasi_number'] = 'nullable|numeric|digits:12';
			//$validation['facebook_link'] = 'required';
			//$validation['twitter_link'] = 'required';
			//$validation['instagram_link'] = 'required';
			$validation['location'] = 'required';           			
			$this->validate($request,$validation);			
			$search  = array('!', '@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
			$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');			
			$name = trim($request['first_name'].$request['last_name']);
			$len=strlen($name);
			$resource_slug=str_replace($search, $replace, $name);
			$resource_slug=str_replace(' ','-',$resource_slug);
			for($i=0;$i<=$len;$i++)
			{
				$resource_slug=str_replace('--','-',$resource_slug);
				$resource_slug=strtolower($resource_slug);
			}
			$slug_array = array();
			$slug_array['user_slug'] = "seller-".$resource_slug;
			$check = DB::table(TBL_USER)->where('user_slug',$slug_array)->where('user_id','!=',session()->get('user_id'))->get();
			if(count($check)>0)
			{
				$resource_slug="seller-".$resource_slug."-".session()->get('user_id');
			}
			else
			{
				$resource_slug="seller-".$resource_slug;
			}
			$update = array();
			if($request->hasFile('profile_logo'))
			{
				$filename=time().".".$request->profile_logo->getClientOriginalExtension();
				//echo $filename;die;
				$request->profile_logo->storeAs('public/profile_image',$filename);
				$location = base_path('storage/app/public/profile_image/thumb');
				$location = $location.'/'.$filename;
				Image::make($request->profile_logo->getRealPath())->resize(200, 100)->save($location,80);
				/* //echo"<pre>";print_r($_FILES);die;
				$file = $_FILES['profile_logo']['name'];
				$type=explode('.',$_FILES['profile_logo']['name']);
				$type1 = $type[0];
				$type2 = $type[1];
				$width = 200;
				$height = 100;
				$file_name=time().'-'.rand(10000,99999).'.'.$type2;
				//echo $type1;die;
				$file_loc = $_FILES['profile_logo']['tmp_name'];
				/* $file_size = $_FILES['image']['size'];
				$file_type = $_FILES['image']['type'];
				$type=explode('.',$_FILES['image']['name']);
				$type1=end($type); 
				$uploade_path="storage/app/public/profile_image/";
				$resize_path="storage/app/public/profile_image/thumb/";
				Image_libary::get_image($file_name,$type2,$width,$height,$file_loc,$uploade_path,$resize_path); */
				$update['profile_logo'] = $filename;
			}
			
			$update['first_name'] = $request->first_name;
			$update['last_name'] = $request->last_name;
			$update['user_slug'] = $resource_slug;
			$update['industry_type'] = $request->industry_type;
			//$update['company_name'] = $request->company_name;
			$update['phone'] = $request->phone;
			$update['website'] = $request->website;
			$update['location'] = $request->location;
			$update['area'] = $request->area;
			$update['type_of_company'] = $request->type_of_company;
			$update['address'] = $request->address;
			$update['company_email'] = $request->company_email;
			$update['block'] = $request->block;
			$update['street'] = $request->street;
			$update['avenue'] = $request->avenue;
			$update['house_building'] = $request->house_building;
			$update['floor'] = $request->building_floor;
			$update['apartment'] = $request->apartment;
			$update['pasi_number'] = $request->pasi_number;
			$update['zipcode'] = $request->zipcode;
			$update['contact_name'] = $request->contact_name;
			$update['contact_email'] = $request->contact_email;
			$update['contact_mobile_number'] = $request->contact_mobile_number;
			$update['contact_office_number'] = $request->contact_office_number;
			$update['bank_name'] = $request->bank_name;
			$update['bank_account_number'] = $request->bank_account_number;
			DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->update($update);
			session()->flash('success','Your profile is edited successfully.');
			return redirect('edit-profile');
		}
	}
	public function buyer_edit(Request $request){
		//echo"<pre>";print_r($request->street);die;
		if(@$request->all()){
			//echo date('Y-m-d',strtotime($request->dob));die;
			$validation = array();
			$validation['first_name'] = 'required';
			$validation['last_name'] = 'required';
			$validation['phone'] = 'required';
			$validation['area'] = 'required';
			$validation['block'] = 'required';
			$validation['street'] = 'required';
			$validation['house_building'] = 'required';
			$validation['gender'] = 'required';
			$validation['dob'] = 'required';
			$this->validate($request,$validation);
			$update = array();
			/* if($request->hasFile('profile_logo'))
			{
				$filename=time().".".$request->profile_logo->getClientOriginalExtension();
				//echo $filename;die;
				$request->profile_logo->storeAs('public/profile_image',$filename);
				$location = base_path('storage/app/public/profile_image/thumb');
				$location = $location.'/'.$filename;
				Image::make($request->profile_logo->getRealPath())->resize(200, 100)->save($location,80);
				$update['profile_logo'] = $filename;
			} */
			//echo"<pre>";print_r($request->street);die;
			$update['first_name'] = $request->first_name;
			$update['last_name'] = $request->last_name;
			$update['phone'] = $request->phone;
			$update['area'] = $request->area;
			$update['block'] = $request->block;
			$update['street'] = $request->street;
			$update['avenue'] = $request->avenue;
			$update['house_building'] = $request->house_building;
			$update['floor'] = $request->floor_no;
			$update['apartment'] = $request->apartment;
			$update['pasi_number'] = $request->pasi_number;
			$update['gender'] = $request->gender;
			$update['dob'] = date('Y-m-d',strtotime($request->dob));
			DB::table(TBL_USER)->where('user_id',session()->get('user_id'))->update($update);
			session()->flash('success','Your profile is edited successfully.');
			return redirect('edit-profile');
		}
	}
	public function get_state(Request $request){
		$state = DB::table(TBL_STATE)
					->where('country_id',$request->country)
					->get();
		$msg="";
		$msg.="<option value=''>State</option>";
		foreach($state as $state){
			$msg.="<option value=".$state->state_id.">".$state->state_name."</option>";
		}
		echo $msg; 
	}
	public function wish_list(){
		$wish_list = DB::table(TBL_ADD_TO_FAVORITE)->select(TBL_ADD_TO_FAVORITE.'.*',TBL_PRODUCT.'.product_title',TBL_PRODUCT.'.product_slug',TBL_PRODUCT.'.product_price',TBL_PRODUCT_TO_IMAGE.'.product_image')
		->leftJoin(TBL_PRODUCT,TBL_ADD_TO_FAVORITE.'.product_id','=',TBL_PRODUCT.'.product_id')
		->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
		->where(TBL_ADD_TO_FAVORITE.'.user_id',session()->get('user_id'))->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')->get();
		//echo "<pre>";print_r($wish_list);die;
		$data = ['wish_list'=>$wish_list];
		return view('english/my_wish_list',$data);
	}
	public function wish_list_delete(Request $request){
		$wish_id = $request->wish_id;
		$wish = DB::table(TBL_ADD_TO_FAVORITE)->where('favorite_id',$wish_id)->first();
		if(@$wish_id && $wish->user_id == session()->get('user_id'))
		{
			DB::table(TBL_ADD_TO_FAVORITE)->where('favorite_id',$wish_id)->delete();
			$responce = array('msg'=>1);
		}
		else
		{
			$responce = array('msg'=>2);
		}
		echo json_encode($responce);
	}
	public function address_book_list(){
		if(session()->get('user_type') == 3)
		{
			$address_book = DB::table(TBL_ADDRESS_BOOK)
							->where('user_id',session()
							->get('user_id'))
							->where('address_status',1)
							->orderBy('default_address','desc')
							->get();
			$arrPrintableAddressFormat=array();
			$addressNum=1;
			foreach($address_book as $key=>$value){
				if($value->default_address==1){
					$arrPrintableAddressFormat[$key]['header']='Default Address';
					$addressNum=1;
				}else{
				$arrPrintableAddressFormat[$key]['header']='Additional Address'.' '.($addressNum);
				$addressNum++;
				}
				$arrPrintableAddressFormat[$key]['name']=$value->first_name.' '.$value->last_name;				
				$arrPrintableAddressFormat[$key]['addressDetails']=$value->address;
				$arrPrintableAddressFormat[$key]['phone']=$value->mobile_number;
				$arrPrintableAddressFormat[$key]['email']=$value->email;
				$arrPrintableAddressFormat[$key]['uniqueTblId']=$value->address_book_id;
				if($key%2==0)$arrPrintableAddressFormat[$key]['alterDesignClass']='info_box';
				else {$arrPrintableAddressFormat[$key]['alterDesignClass']='info_box info_box_2';}	
						
			}			
			$data = ['bookedAddtitionalAddress'=>$arrPrintableAddressFormat];
			return view((App::getLocale()=='en')?'english.address_book':'arabic.address_book',$data);
		}
		else{
			return redirect('dashboard');
		}
	}
	public function add_address(Request $request){
		if(session()->get('user_type') == 3){	
			if(@$request->all()){
				//echo date('Y-m-d',strtotime($request->dob));die;
				$validation = array();
				$validation['first_name'] = 'required';
				$validation['last_name'] = 'required';
				$validation['email'] = 'required';
				$validation['mobile_number'] = 'required';
				$validation['address'] = 'required';
				$validation['latitude'] = 'required';
				$validation['longitude'] = 'required';
				$validation['area'] = 'required';
				$validation['block'] = 'required';
				$validation['street'] = 'required';			
				$validation['house_building'] = 'required';			
				$validation['pasi_number'] = 'nullable|max:12';
				$this->validate($request,$validation);
				$arrInsertAddress = array();
				
				$arrInsertAddress['first_name'] = $request->first_name;
				$arrInsertAddress['last_name'] = $request->last_name;
				$arrInsertAddress['email'] = $request->email;
				$arrInsertAddress['mobile_number'] = $request->mobile_number;
				$arrInsertAddress['area'] = $request->area;
				$arrInsertAddress['address'] = $request->address;
				$arrInsertAddress['latitude'] = $request->latitude;
				$arrInsertAddress['longitude'] = $request->longitude;
				$arrInsertAddress['area'] = $request->area;
				$arrInsertAddress['block'] = $request->block;
				$arrInsertAddress['street'] = $request->street;
				$arrInsertAddress['avenue'] = $request->avenue;
				$arrInsertAddress['house_building'] = $request->house_building;
				$arrInsertAddress['floor'] = $request->building_floor;
				$arrInsertAddress['apartment'] = $request->apartment;
				$arrInsertAddress['pasi_number'] = $request->pasi_number;
				$arrInsertAddress['user_id'] = session()->get('user_id');
				//Update default address
				if(@$request->default_shipping_address){
					$defaultShippingAddress=DB::table(TBL_ADDRESS_BOOK)
											->where('default_address',1)
											->where('user_id',session()->get('user_id'))
											->first();
					if(count($defaultShippingAddress)){
						DB::table(TBL_ADDRESS_BOOK)
							->where('user_id',session()->get('user_id'))
							->where('default_address',1)
							->update(array('default_address'=>0));
					}
					$arrInsertAddress['default_address'] = 1;// 1 for set the address as default address			
				}
				
				DB::table(TBL_ADDRESS_BOOK)->insert($arrInsertAddress);
				session()->flash('success','Address added successfully.');
				return redirect('address-book');
			}
			return view((App::getLocale()=='en')?'english.add_address':'arabic.add_address');
		}else{
		return redirect('dashboard');
		}
	}
	public function delete_address(Request $request,$id){
		$address_details = DB::table(TBL_ADDRESS_BOOK)->where('address_book_id',$id)->where('user_id',session()->get('user_id'))->where('address_status',1)->first();
		if(session()->get('user_type') == 3 && count($address_details))
		{
			DB::table(TBL_ADDRESS_BOOK)->where('address_book_id',$id)->delete();
			session()->flash('success','Address deleted successfully.');
			return redirect('address-book');
		}
		else
		{
			return redirect('dashboard');	
		}
	}
	public function edit_address(Request $request,$id){
		$address_details = DB::table(TBL_ADDRESS_BOOK)
								->where('address_book_id',$id)
								->where('user_id',session()->get('user_id'))
								->where('address_status',1)
								->first();
		if(session()->get('user_type') == 3 && count($address_details)){
			if(@$request->all()){
				$validation = array();
				$validation['first_name'] = 'required';
				$validation['last_name'] = 'required';
				$validation['email'] = 'required';
				$validation['mobile_number'] = 'required';
				$validation['address'] = 'required';
				$validation['area'] = 'required';
				$validation['latitude'] = 'required';
				$validation['longitude'] = 'required';
				$validation['block'] = 'required';
				$validation['street'] = 'required';			
				$validation['house_building'] = 'required';			
				$validation['pasi_number'] = 'nullable|max:12';
				$this->validate($request,$validation);
				$arrUpdateAddress = array();
				
				$arrUpdateAddress['first_name'] = $request->first_name;
				$arrUpdateAddress['last_name'] = $request->last_name;
				$arrUpdateAddress['email'] = $request->email;
				$arrUpdateAddress['mobile_number'] = $request->mobile_number;
				$arrUpdateAddress['area'] = $request->area;
				$arrUpdateAddress['address'] = $request->address;
				$arrUpdateAddress['latitude'] = $request->latitude;
				$arrUpdateAddress['longitude'] = $request->longitude;
				$arrUpdateAddress['area'] = $request->area;
				$arrUpdateAddress['block'] = $request->block;
				$arrUpdateAddress['street'] = $request->street;
				$arrUpdateAddress['avenue'] = $request->avenue;
				$arrUpdateAddress['house_building'] = $request->house_building;
				$arrUpdateAddress['floor'] = $request->building_floor;
				$arrUpdateAddress['apartment'] = $request->apartment;
				$arrUpdateAddress['pasi_number'] = $request->pasi_number;
				if(@$request->default_shipping_address){
					$defaultShippingAddress=DB::table(TBL_ADDRESS_BOOK)
											->where('default_address',1)
											->where('user_id',session()->get('user_id'))
											->first();
					if(count($defaultShippingAddress)){
						DB::table(TBL_ADDRESS_BOOK)
							->where('user_id',session()->get('user_id'))
							->where('default_address',1)
							->update(array('default_address'=>0));
					}
					$arrUpdateAddress['default_address'] = 1;// 1 for set the address as default address			
				}else{
					DB::table(TBL_ADDRESS_BOOK)							
							->where('address_book_id',$id)
							->update(array('default_address'=>0));
				}				
				DB::table(TBL_ADDRESS_BOOK)
					->where('address_book_id',$id)
					->update($arrUpdateAddress);
				session()->flash('success','Address book updated successfully.');
				return redirect('address-book');
			}
			$data=['uniqueTblId'=>$id,'addressDetails'=>$address_details];
			return view((App::getLocale()=='en')?'english.edit_address':'arabic.edit_address',$data);
	    }
		else
		{
			return redirect('dashboard');
		}
	}
	public function seller_store(Request $request){
		$data = array();
		if(@$request->all()){	
			$validation = array();
			$validation['store_address'] = 'required';
			$validation['latitude'] = 'required';
			$validation['longitude'] = 'required';
			$validation['area'] = 'required';
			$validation['block'] = 'required';
			$validation['street'] = 'required';
			$validation['house_building'] = 'required';
			$this->validate($request,$validation);	
			$insert = array();
			$insert['branch_location'] = $request->branch_location;
			$insert['store_phone'] = $request->store_phone;
			$insert['store_mail'] = $request->store_mail;
			$insert['store_address'] = $request->store_address;
			$insert['latitude'] = $request->latitude;
			$insert['longitude'] = $request->longitude;
			$insert['area'] = $request->area;
			$insert['block'] = $request->block;
			$insert['street'] = $request->street;
			$insert['avenue'] = $request->avenue;
			$insert['house_building'] = $request->house_building;
			$insert['floor'] = $request->floor_no;
			$insert['apperment'] = $request->apperment;
			$insert['post_code'] = $request->post_code;
			$insert['pasi_no'] = $request->pasi_no;
			$insert['user_id'] = session()->get('user_id');
			DB::table(TBL_SELLER_STORE)->insert($insert);
			session()->flash('success','Seller store added successfully.');
			return redirect('seller-store');
		}
		$get_store = DB::table(TBL_SELLER_STORE)
						->where('user_id',session()
						->get('user_id'))
						->where('store_status',1)
						->get();
		$data['store'] = $get_store;
		if(App::getLocale()=='en')return view('english.seller_store',$data);
		if(App::getLocale()=='ar')return view('arabic.seller_store',$data);
	}
	public function seller_store_edit(Request $request,$id){
		if(@$id && session()->get('user_type') == 2){
			$fetch_store = DB::table(TBL_SELLER_STORE)->where('user_id',session()->get('user_id'))->where('store_id',$id)->first();
			if(count($fetch_store)>0){
				$data = array();
				if(@$request->all()){
					$validation = array();
					$validation['store_address'] = 'required';
					$validation['area'] = 'required';
					$validation['block'] = 'required';
					$validation['street'] = 'required';
					$validation['store_address'] = 'required';
					$validation['latitude'] = 'required';
					$validation['longitude'] = 'required';
					$validation['house_building'] = 'required';
					$this->validate($request,$validation);	
					$insert = array();
					$insert['branch_location'] = $request->branch_location;
					$insert['store_phone'] = $request->store_phone;
					$insert['store_mail'] = $request->store_mail;
					$insert['store_address'] = $request->store_address;
					$insert['latitude'] = $request->latitude;
					$insert['longitude'] = $request->longitude;
					$insert['area'] = $request->area;
					$insert['block'] = $request->block;
					$insert['street'] = $request->street;
					$insert['avenue'] = $request->avenue;
					$insert['house_building'] = $request->house_building;
					$insert['floor'] = $request->floor_no;
					$insert['apperment'] = $request->apperment;
					$insert['post_code'] = $request->post_code;
					$insert['pasi_no'] = $request->pasi_no;
					$insert['user_id'] = session()->get('user_id');					
					DB::table(TBL_SELLER_STORE)->where('store_id',$id)->update($insert);
					session()->flash('success','Successfully updated.');
					return redirect('seller-store');
				}
				$get_store = DB::table(TBL_SELLER_STORE)
							->where('user_id',session()->get('user_id'))
							->where('store_status',1)
							->get();
				$data['store'] = $get_store;
				$data['fetch_store'] = $fetch_store;
				if(App::getLocale()=='en')return view('english.seller_store',$data);
				if(App::getLocale()=='ar')return view('arabic.seller_store',$data);
			}else{
				return redirect('dashboard');
			}
		}else{
			return redirect('dashboard');
		}
	}
	public function store_delete(Request $request,$id){
		if(@$id && session()->get('user_type') == 2){
			$fetch_store = DB::table(TBL_SELLER_STORE)->where('user_id',session()->get('user_id'))->where('store_id',$id)->first();
			if(count($fetch_store)>0){
				$update = array();
				$update['store_status'] = 2;
				DB::table(TBL_SELLER_STORE)->where('store_id',$id)->update($update);
				session()->flash('success','Seller store delete successfully.');
				return redirect('seller-store');
			}else{
				return redirect('dashboard');
			}
		}else{
			return redirect('dashboard');
		}
	}
	public function shopping_cart()
	{
		$get_cart = DB::table(TBL_CART_MASTER)->select(TBL_CART_MASTER.'.*',TBL_CART_DETAILS.'.*',TBL_PRODUCT.'.product_title',TBL_PRODUCT.'.product_slug',TBL_PRODUCT.'.product_quentity',TBL_PRODUCT_TO_IMAGE.'.product_image',TBL_USER.'.first_name',TBL_USER.'.last_name',TBL_USER.'.user_slug')
		->leftJoin(TBL_CART_DETAILS,TBL_CART_MASTER.'.cart_master_id','=',TBL_CART_DETAILS.'.cart_master_id')
		->leftJoin(TBL_PRODUCT,TBL_CART_DETAILS.'.product_id','=',TBL_PRODUCT.'.product_id')
		->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
		->leftJoin(TBL_USER,TBL_CART_DETAILS.'.seller_id','=',TBL_USER.'.user_id')
		->where(TBL_CART_MASTER.'.user_id',session()->get('user_id'))
		->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')
		->get();
		//echo "<pre>";print_r($get_cart);die;
		$data = array();
		$data['cart_item'] = $get_cart;
		if(App::getLocale()=='en')
		{
			return view('english.shopping_cart',$data);
		}
		if(App::getLocale()=='ar')
		{
			return view('arabic.shopping_cart',$data);
		}
	}
	public function delete_cart(Request $request)
	{
		$cart = DB::table(TBL_CART_DETAILS)->where('cart_details_id',$request->details_id)
		->leftJoin(TBL_CART_MASTER,TBL_CART_DETAILS.'.cart_master_id','=',TBL_CART_MASTER.'.cart_master_id')->first();
		$cart = DB::table(TBL_CART_DETAILS)->where('cart_details_id',$request->details_id)
		->leftJoin(TBL_CART_MASTER,TBL_CART_DETAILS.'.cart_master_id','=',TBL_CART_MASTER.'.cart_master_id')->first();
		if(count($cart)>0 && $cart->user_id == session()->get('user_id'))
		{
			$get_sub_total = ($cart->cart_sub_total-$cart->total_price);
			$cart_master_update = array();
			//$cart_sub_total = $get_sub_total+($request->product_qty*$cart_total);
				
			$cart_master_update['cart_sub_total'] = $get_sub_total;
			$cart_master_update['cart_total'] = $get_sub_total;
			//$cart_master_update['cart_item_no'] = $fetch_cart_master->cart_item_no+1;
			DB::table(TBL_CART_MASTER)->where('cart_master_id',$cart->cart_master_id)->update($cart_master_update);
			
			DB::table(TBL_CART_DETAILS)->where('cart_details_id',$request->details_id)->delete();
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
			echo json_encode($responce);
		}
	}
	public function seller_profile($slug)
	{
		if(App::getLocale()=='en')
		{
			return view('english.seller_profile');
		}
		if(App::getLocale()=='ar')
		{
			return view('arabic.seller_profile');
		}
	}
}
