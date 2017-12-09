<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
use Mail;//this is a facade
use App\Mail\registrationMail;
use App\Mail\sendMail;
use Route;
class HomeController extends Controller
{
    public function index(){
		if(App::getLocale()=='en'){
			return view('english.home');
		}
		if(App::getLocale()=='ar'){
			return view('arabic.home');
		}
	 }
	public function customer_signup(Request $request){
		if(@$request->all()){	
			$validation = array();
			$validation['fname']='required';
			$validation['lname']='required';
			$validation['email']='required';
			$validation['password']='required';
			$validation['conf_password']='required';
			$this->validate($request,$validation);
			if($request->password == $request->conf_password){
				$v_code = rand('000000','999999');
				$insert =array();
				$insert['first_name'] = $request->fname;
				$insert['last_name'] = $request->lname;
				$insert['email'] = $request->email;
				$insert['password'] = md5($request->password);
				$insert['vcode'] = $v_code;
				$insert['user_status'] = 0;
				$insert['date_of_registration'] = date('Y-m-d H:i:s');
				$insert['user_type'] = 3;
				$insert['is_email_verified'] = 0;
				$insert_id = DB::table(TBL_USER)->insertGetId($insert);
				$request->id=$insert_id;
				$request->v_code=$v_code;
				Mail::send(new registrationMail());
				
				session()->put('message','resistration-success');
				return redirect('success');
			}
		}
		if(App::getLocale()=='en')
		{
			return view('english.customer_signup');
		}
		if(App::getLocale()=='ar')
		{
			return view('arabic.customer_signup');
		}
	}
	public function seller_signup(Request $request){
		if(@$request->all()){
			$validation = array();
			$validation['fname']='required';
			$validation['lname']='required';
			$validation['email']='required';
			$validation['password']='required';
			$validation['conf_password']='required';
			$this->validate($request,$validation);
			if($request->password == $request->conf_password){
				$v_code = rand('000000','999999');
				$insert =array();
				$insert['first_name'] = $request->fname;
				$insert['last_name'] = $request->lname;
				$insert['email'] = $request->email;
				$insert['password'] = md5($request->password);
				$insert['company_name'] = $request->company_name;
				$insert['vcode'] = $v_code;
				$insert['user_status'] = 0;
				$insert['date_of_registration'] = date('Y-m-d H:i:s');
				$insert['user_type'] = 2;
				$insert['is_email_verified'] = 0;
				$insert_id = DB::table(TBL_USER)->insertGetId($insert);				
				$search  = array('!', '@', '#', '$', '%', '^','&', '*', '(', ')', '-', '+', '=', '|', '~', '`', ',', '.', ';', ':', '"', '{', '}' ,"'",'?',',','>');
				$replace = array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ' , ' ', ' ', ' ', ' ', ' ', ' ',' ',' ',' ',' ');			
				$name = trim($insert['first_name'].$insert['last_name']);
				$len=strlen($name);
				$resource_slug=str_replace($search, $replace, $name);
				$resource_slug=str_replace(' ','-',$resource_slug);
				for($i=0;$i<=$len;$i++){
					$resource_slug=str_replace('--','-',$resource_slug);
					$resource_slug=strtolower($resource_slug);
				}
				$slug_array = array();
				$slug_array['user_slug'] = "seller-".$resource_slug;
				$check = DB::table(TBL_USER)->where('user_slug',$slug_array)->get();
				if(count($check)>0){
					$resource_slug="seller-".$resource_slug."-".$insert_id;
				}else{
					$resource_slug="seller-".$resource_slug;
				}
				$update_slug=array();
				$update_slug['user_slug']=$resource_slug;
				DB::table(TBL_USER)->where('user_id',$insert_id)->update($update_slug);
				$request->id=$insert_id;
				$request->v_code=$v_code;
				Mail::send(new registrationMail());
				session()->put('message','resistration-success');
				return redirect('success');
			}
		}
		if(App::getLocale()=='en'){
			return view('english.seller_signup');
		}
		if(App::getLocale()=='ar'){
			return view('arabic.seller_signup');
		}
	}
	public function login(Request $request){
		if(@$request->all()){	
			$details = DB::table(TBL_USER)->where('email',$request->email)->where('password',md5($request->password))->where('user_type','!=',1)->first();
			if(count($details)>0){
				if($details->user_type == 2){
					if($details->is_email_verified == 1 && ($details->user_status == 0 || $details->user_status == 1 )){
						session()->put('user_id',$details->user_id);
						session()->put('user_type',$details->user_type);
						return redirect('dashboard');
					}
					if($details->is_email_verified == 0){
						session()->flash('msg','Please verify your email first.');
						return redirect('login');
					}else{
						session()->flash('msg','You are not active user.');
						return redirect('login');
					}
				}
				if($details->user_type == 3){
					if($details->user_status == 1 && $details->is_email_verified == 1){
						session()->put('user_id',$details->user_id);
						session()->put('user_type',$details->user_type);
						return redirect('dashboard');
					}
					if($details->is_email_verified == 0){
						session()->flash('msg','Please verify your email first.');
						return redirect('login');
					}else{
						session()->flash('msg','You are not active user.');
						return redirect('login');
					}
				}
			}else{
				session()->flash('msg','Invalid login credential.');
				return redirect('login');
			}
		}
		if(App::getLocale()=='en'){
			return view('english.login');
		}
		if(App::getLocale()=='ar'){
			return view('arabic.login');
		}
	}
	
	public function message(){		
		if(session()->get('message') == ""){
			return redirect('login');
		}
		$data['message'] = session()->get('message');
		session()->put('message','');
		return view('message',$data);
	}
	public function activate($key){
		if(@$key){
		$vcode=explode('_',$key);
		$get_user = DB::table(TBL_USER)->where('user_id',$vcode[1])->first();
			if(@$get_user && $get_user->vcode != ""){
				if(@$get_user->user_type == 3){
					if($get_user->user_status == 0 && $get_user->vcode != ""){
						$update = array();
						$update['user_status']=1;
						$update['vcode']=null;
						$update['is_email_verified']=1;
						DB::table(TBL_USER)->where('user_id',$vcode[1])->update($update);
						session()->put('message','mail-verification');
						return redirect('success');
					}else{
						return redirect('login');
					}
				}
				if(@$get_user->user_type == 2){
					if($get_user->user_status == 0 && $get_user->vcode != ""){
						$update = array();
						$update['user_status']=0;
						$update['vcode']=null;
						$update['is_email_verified']=1;
						DB::table(TBL_USER)->where('user_id',$vcode[1])->update($update);
						session()->put('message','mail-verification');
						return redirect('success');
					}else{
						return redirect('login');
					}
				}else{
					return redirect('login');
				}
			}else{
				session()->put('message','expired_link');
				return redirect('success');
			}
		}
	}
	
	public function logout(){
		session()->put('user_id','');
		session()->put('user_type','');
		session()->flash('msg','You have successfully logout.');
		return redirect('login');
	}
	public function forget_password(Request $request){
		if(@$request->all()){
			$validation = array();
			$validation['email'] = 'required';
			$this->validate($request,$validation);
			$fetch_email = DB::table(TBL_USER)->where('email',$request->email)->where('user_status','!=',4)->first();
			if(count($fetch_email)>0)
			{
				$data = array();
				$data['id'] = md5($fetch_email->user_id);
				$data['fname'] = $fetch_email->first_name;
				$data['lname'] = $fetch_email->last_name;
				$data['email'] = $request->email;
				$data['reset_url'] = 'reset-password/'.$data['id'];
				Mail::send(new sendMail($data));
				session()->put('message','forgetpassword');
				return redirect('success');
			}
			else
			{
				session()->flash('msg','Opps! something went wrong.');
				return redirect('forget-password');
			}
		}
		if(App::getLocale()=='en'){
			return view('english.forget_password');
		}
		if(App::getLocale()=='ar'){
			return view('arabic.forget_password');
		}
	}
	
	public function reset_password(Request $request,$id){
		//echo $id;die;
		//DB::enableQueryLog();
		$check = DB::table(TBL_USER)->where(DB::raw('md5(user_id)'),$id)->first();
		$query = DB::getQueryLog();
		//echo '<pre>'; print_r($query);
		//echo '<pre>'; print_r($check);
		//die; 
		if(count($check)>0)
		{
			if(@$request->all())
			{
				if($request->password == $request->cpassword)
				{
					$update = array();
					$update['password'] = md5($request->password);
					DB::table(TBL_USER)->where('user_id',$check->user_id)->update($update);
					session()->put('message','resetpassword');
					return redirect('success');
				}
				else
				{
					session()->flash('msg','Confirm password does not match');
					return redirect('reset-password/'.$id);
				}
			}
			if(App::getLocale()=='en')
			{
				return view('english.reset_password');
			}
			if(App::getLocale()=='ar')
			{
				return view('arabic.reset_password');
			}
		}
		else
		{
			return redirect('login');
		}
	}
}
