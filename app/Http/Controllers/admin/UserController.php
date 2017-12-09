<?php
namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;//this is a facade
use App\Mail\adminMail;
use App\Mail\userMail;
use Image;
use File;
use App\Image_lib\Image_libary;
class UserController extends Controller
{
    public function delivery_staff(Request $request){
	   //DB::enableQueryLog();
       $user = DB::table(TBL_USER);
	   $post_data = $request->all();
	   if(@$post_data){
			if(@$request->status){
			  $user = $user->where('user_status',$request->status);
			}
			if(@$request->keyword){
				$user = $user->where(function($where) use ($request){
					      $where->where('first_name','like','%'.$request->keyword.'%')
						  ->orwhere('last_name','like','%'.$request->keyword.'%')
						  ->orwhere('email','like','%'.$request->keyword.'%')
						  ->orWhereRaw("concat(first_name, ' ',last_name) like '%".$request->keyword."%' ");
						});
			}
			$users = $user->where('user_type',4)->where('user_status','!=',5)->orderBy('user_id', 'DESC')->paginate(25);
	    }else{
		   $users = $user->where('user_type',4)->where('user_status','!=',5)->orderBy('user_id', 'DESC')->paginate(25);
	    }
	   //echo "<pre>";print_r($user);die;
	   $data = ['delivery'=>$users,'post_data'=>$request->all()];
	   return view('admin.delivery_staff_list',$data);
    }
	public function add_staff(Request $request){
		$post_data = $request->all();
		$pass = rand('000000','999999');
		if(@$post_data)
		{
			//echo "<pre>";print_r($request->profile_logo);die;
			$check_email = DB::table(TBL_USER)->where('email',$request->email)->get();
			if(count($check_email)>0)
			{
				session()->flash('success','Email already exist');
				return redirect('admin-add-delivery-staff');
			}
			else
			{
				$insert = array();
				if($request->hasFile('profile_logo'))
				{
					$filename=time().".".$request->profile_logo->getClientOriginalExtension();
					//echo $filename;die;
					$request->profile_logo->storeAs('public/profile_image',$filename);
					$location = base_path('storage/app/public/profile_image/thumb');
					$location = $location.'/'.$filename;
					Image::make($request->profile_logo->getRealPath())->resize(200, 100)->save($location,80);
					$insert['profile_logo'] = $filename;
				}
				//die;
				$insert['first_name'] = $request->first_name;
				$insert['last_name'] = $request->last_name;
				$insert['email'] = $request->email;
				$insert['password'] = md5($request->password);
				$insert['user_type'] = 4;
				$insert['user_status'] = 1;
				
				DB::table(TBL_USER)->insert($insert);
				$request->pass=$request->password;
				$request->subject='Delivery Staff';
				Mail::send(new adminMail());
				
				session()->flash('success','Delivery staff added successfully');
				return redirect('admin-delivery-staff-list');
			}
		}
		//echo $pass;die;
		$data = ['pass'=>$pass];
		return view('admin.add_delivery_staff',$data);
    }
	public function edit_staff(Request $request,$id){
		$post_data = $request->all();
		if(@$post_data){
			$check_email = DB::table(TBL_USER)->where('email',$request->email)->where('user_id','!=',$id)->get();
			if(count($check_email)>0){
				session()->flash('success','Email already exist');
				return redirect('admin-edit-delivery-staff/'.$id);
			}else{
				$insert = array();
				$insert['first_name'] = $request->first_name;
				$insert['last_name'] = $request->last_name;
				$insert['email'] = $request->email;
				if(@$request->password)
				{
					$insert['password'] = md5($request->password);
				}
				DB::table(TBL_USER)->where('user_id',$id)->update($insert);
				$request->pass=$request->password;
				$request->subject='Change Password';
				Mail::send(new adminMail());
				session()->flash('success','Delivery staff edit successfully');
				return redirect('admin-delivery-staff-list');
			}
		}
		//echo $pass;die;
		$fetch_user = DB::table(TBL_USER)->where('user_id',$id)->first();
		//echo "<pre>";print_r($fetch_user);die;
		$data = ['user'=>$fetch_user];
		return view('admin.edit_delivery_staff',$data);
    }
	public function ajax_email(Request $request){
		//echo $request->email;die;
		$check_email = DB::table(TBL_USER)->where('email',$request->email)->where('user_status','!=',5)->get();
		if(count($check_email)>0){
			echo "1";
		}else{
			echo "2";
		}
	}
	public function ajax_email1(Request $request){
		//echo $request->email;die;
		$check_email = DB::table(TBL_USER)->where('email',$request->email)->where('user_id','!=',$request->user_id)->where('user_status','!=',5)->get();
		if(count($check_email)>0){
			$responce = array('msg'=>1);
		}else{
			$responce = array('msg'=>2);
		}
		echo json_encode($responce);
	}
	public function deliverystaff_status($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->where('user_type',4)->first();
		if($user->user_status == 1){
			$update = array('user_status'=>2);
		}else{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','Delivery staff status chenge successfully');
		return redirect('admin-delivery-staff-list');
	}
	public function deliverystaff_delete($id){
		$user = DB::table(TBL_USER)->where('user_id',$id)->where('user_type',4)->first();
		$update = array('user_status'=>5);
		DB::table(TBL_USER)->where('user_id',$id)->update($update);
		session()->flash('success','Delivery staff deleted successfully');
		return redirect('admin-delivery-staff-list');
	}
	public function customers_list(Request $request){
		$user = DB::table(TBL_USER);
		$post_data = $request->all();
		if(@$post_data){
			if(@$request->status){
			  $user = $user->where('user_status',$request->status);
			}
			if(@$request->keyword){
				$user = $user->where(function($where) use ($request){
					    $where->where('first_name','like','%'.$request->keyword.'%')
						->orwhere('last_name','like','%'.$request->keyword.'%')
						->orwhere('email','like','%'.$request->keyword.'%')
						->orWhereRaw("concat(first_name, ' ',last_name) like '%".$request->keyword."%' ");
				});
			}
			$users = $user->where('user_type',3)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
			$query = DB::getQueryLog();
	    }
		else
		{
		   $users = $user->where('user_type',3)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
	    }
		$data = ['user'=>$users,'post_data'=>$request->all()];
		return view('admin.customers_list',$data);
	}
	public function sellers_list(Request $request){
		$user = DB::table(TBL_USER);
		$post_data = $request->all();
		if(@$post_data){
			if(@$request->status){
				if($request->status == 5){
					$status = 0;
				}else{
					$status = $request->status;
				}
			$user = $user->where('user_status',$status);
			}
			if(@$request->keyword){
				$user = $user->where(function($where) use ($request){
					    $where->where('first_name','like','%'.$request->keyword.'%')
						->orwhere('last_name','like','%'.$request->keyword.'%')
						->orwhere('email','like','%'.$request->keyword.'%')
						->orWhereRaw("concat(first_name, ' ',last_name) like '%".$request->keyword."%' ");
				});
			}
			$users = $user->where('user_type',2)
						   ->where('user_status','!=',3)
						   ->orderBy('user_id', 'DESC')
						   ->paginate(25);
			$query = DB::getQueryLog();
		}
		else
		{
		   $users = $user->where('user_type',2)->where('user_status','!=',3)->orderBy('user_id', 'DESC')->paginate(25);
		}
		$data = ['user'=>$users,'post_data'=>$request->all()];	  
		return view('admin.sellers_list',$data);
	}
	public function customer_status($id){
		$user = DB::table(TBL_USER)
					->where('user_id',$id)
					->first();
		if($user->user_status == 1){
			$update = array('user_status'=>2);
		}else{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)
			->where('user_id',$id)
			->update($update);
		session()->flash('success','User status change successfully');
		return redirect('admin-customers-list');
	}
	public function seller_status($id){
		$user = DB::table(TBL_USER)
					->where('user_id',$id)
					->first();
		if($user->user_status == 1){
			$update = array('user_status'=>2);
		}else{
			$update = array('user_status'=>1);
		}
		DB::table(TBL_USER)
			->where('user_id',$id)
			->update($update);
		session()->flash('success','User status change successfully');
		return redirect('admin-sellers-list');
	}
	public function seller_approve($id){
		$user = DB::table(TBL_USER)
					->where('user_id',$id)
					->where('is_email_verified',1)
					->first();
		if($user->user_status == 0){
			$update = array('user_status'=>1);
		}
		$mailIdForSeller=$user->email;
		$nameOfSeller=$user->first_name.' '.$user->last_name;
		//fire a mail to approve that seller account
		 $mailSubject='Account approved';
		Mail::send(new userMail($mailIdForSeller,$nameOfSeller,$mailSubject));
			DB::table(TBL_USER)
				->where('user_id',$id)
				->update($update);
		session()->flash('success','Successfully approved.');
		return redirect('admin-sellers-list');
	}
	public function customer_details($id){
			$users = DB::table(TBL_USER)
					->where('user_id',$id)
					->where('user_type',3)
					->first();
		if(count($users)>0){
			$data = ['user'=>$users];
			return view('admin.customer_details',$data);
		}else{
			return redirect('admin-customers-list');
		}
	}
	public function seller_details($id){
				$users = DB::table(TBL_USER)
							->select(TBL_USER.'.*',TBL_COUNTRY.'.country_name')
							->leftJoin(TBL_COUNTRY,TBL_USER.'.country', '=' ,TBL_COUNTRY.'.country_id')
							->where('user_id',$id)
							->where('user_type',2)
							->first();
		if(count($users)>0){
			$data = ['user'=>$users];
			return view('admin.seller_details',$data);
		}else{
			return redirect('admin-sellers-list');
		}
	}
	public function customer_delete($id){
			$user = DB::table(TBL_USER)
						->where('user_id',$id)
						->first();
			$update = array('user_status'=>3);
			DB::table(TBL_USER)
				->where('user_id',$id)
				->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-customers-list');
	}
	public function seller_delete($id){
					$user = DB::table(TBL_USER)
							->where('user_id',$id)							
							->first();
					$update = array('user_status'=>3);
					DB::table(TBL_USER)
							->where('user_id',$id)
							->update($update);
		session()->flash('success','User deleted successfully');
		return redirect('admin-sellers-list');
	}
	public function admin_change_multi_seller_status(Request $request){
		if(@$request->user){
			$nothingToChangeFlag=true;
			$arrOfUsers=$request->user;
			if(@$request->action=='Approve'){
				//only for sellers
				//when users status=0 beacuse those seller are not approved by admin still yet.
					
					foreach($arrOfUsers as $userId){
						$user = DB::table(TBL_USER)
								->where('user_id',$userId)
								->where('is_email_verified',1)
								->where('user_status',0)
								->first();
						if(count($user)){
							//a mail is fired for seller approval
							$mailIdForSeller=$user->email;
							$nameOfSeller=$user->first_name.' '.$user->last_name;
							//fire a mail to approve that seller account$nameOfSeller
							 $mailSubject='Account approved';
							 Mail::send(new userMail($mailIdForSeller,$nameOfSeller,$mailSubject));
							//update the user status 0 to 1 and change the seller as active.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->where('is_email_verified',1)
								->update(array('user_status'=>1));
						$nothingToChangeFlag=false;
						}
					}	
			}
			elseif(@$request->action=='Inactive'){
				//users status=1 //active users				
					foreach($arrOfUsers as $userId){
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)
									->where('is_email_verified',1)
									->where('user_status',1)
									->first();
						if(count($user)){							
							//update the user status 1 to 2 and change the user status is inactive.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>2));
							$nothingToChangeFlag=false;
						}		
					}
			}
			elseif(@$request->action=='Active'){
					foreach($arrOfUsers as $userId){
					//only users status=2 //for inactive users	
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)
									->where('is_email_verified',1)
									->where('user_status',2)
									->first();
						if(count($user)){							
							//update the user status 2 to 1 and change the user status is active.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>1));
						$nothingToChangeFlag=false;
						}		
					}
				
			}
			if($nothingToChangeFlag){
				session()->flash('info','Nothing to change.');
				return redirect('admin-sellers-list');	
			}
			session()->flash('success','Users status change successfully.');
		    return redirect('admin-sellers-list');
		}else{
		 return redirect('admin-sellers-list');
		}
	}
	public function admin_change_multi_customer_status(Request $request){
		if(@$request->user){
			$nothingToChangeFlag=true;
			$arrOfUsers=$request->user;			
			if(@$request->action=='Inactive'){
				//users status=1 //active users				
					foreach($arrOfUsers as $userId){
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)
									->where('is_email_verified',1)
									->where('user_status',1)
									->first();
						if(count($user)){							
							//update the user status 1 to 2 and change the user status is inactive.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>2));
						$nothingToChangeFlag=false;
						}		
					}
			}
			elseif(@$request->action=='Active'){
					foreach($arrOfUsers as $userId){
					//only users status=2 //for inactive users	
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)
									->where('is_email_verified',1)
									->where('user_status',2)
									->first();
						if(count($user)){							
							//update the user status 2 to 1 and change the user status is active.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>1));
						$nothingToChangeFlag=false;		
						}		
					}
			}
			if($nothingToChangeFlag){
				session()->flash('info','Nothing to change.');
				return redirect('admin-customers-list');	
			}
			session()->flash('success','Users status change successfully.');
		    return redirect('admin-customers-list');
		}else{
		 return redirect('admin-customers-list');
		}
	}
	public function admin_multi_delivery_staff_change_status(Request $request){
		if(@$request->user){
			$nothingToChangeFlag=true;
			$arrOfUsers=$request->user;			
			if(@$request->action=='Inactive'){
				//users status=1 //active users				
					foreach($arrOfUsers as $userId){
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)									
									->where('user_status',1)
									->first();
						if(count($user)){							
							//update the user status 1 to 2 and so show the user status as inactive.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>2));
						$nothingToChangeFlag=false;
						}		
					}
			}
			elseif(@$request->action=='Active'){
					foreach($arrOfUsers as $userId){
					//only users status=2 //for inactive users	
						$user = DB::table(TBL_USER)
									->where('user_id',$userId)									
									->where('user_status',2)
									->first();
						if(count($user)){							
							//update the user status 2 to 1 and show the user status as active.
							DB::table(TBL_USER)
								->where('user_id',$userId)
								->update(array('user_status'=>1));
						$nothingToChangeFlag=false;		
						}		
					}
			}
			if($nothingToChangeFlag){
				session()->flash('info','Nothing to change.');
				return redirect('admin-delivery-staff-list');	
			}
			session()->flash('success','Users status change successfully.');
		    return redirect('admin-delivery-staff-list');
		}else{
		 return redirect('admin-delivery-staff-list');
		}
	}

}
