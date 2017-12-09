<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    Public function login(Request $request)
	{
		
		$this->validate($request,[
		'email'=>'required|email',
		'password'=>'required',
	    ]);
		//echo "<pre>";print_r($request->all());exit;
		$details = DB::table(TBL_USER)
					->where('email',$request->email)
					->where('password',md5($request->password))
					->where('user_type',1)
					->first();
		 
		if(count($details)>0)
		{
			if($details->user_status == 1)
			{
				session()->put('admin_id',$details->user_id);
				session()->put('admin_name',$details->first_name.' '.$details->last_name);
				return redirect('admin-dashboard');
			}
			else
			{
				session()->flash('success','You are not active user');
				return redirect('admin');
			}
		}
		else
		{
			session()->flash('success','Your email password does not match.');
			return redirect('admin');
		}
		return redirect('admin');
	}
	public function dashboard()
	{		
		//echo session()->get('admin_id');die;
		return view('admin.dashboard');
	}
	public function logout()
	{
		session()->put('admin_id','');
		session()->flash('success','You have successfully logout.');   		
		return redirect('admin');
	}
	public function change_password(Request $request)
	{
		$post_data = $request->all();
		//echo session()->get('admin_id');die;
		if(@$post_data)
		{
			$this->validate($request,[
			'curr_password'=>'required',
			'new_password'=>'required',
			'conf_password'=>'required',
			]);
			$request_curr_password 	= $request->curr_password;
			$request_new_password 	= $request->new_password;
			$request_conf_password 	= $request->conf_password;
			$curr_password = md5($request_curr_password);
			$user_data =DB::table(TBL_USER)
						->where('user_id',session()
						->get('admin_id'))
						->first();
			if($user_data->password==$curr_password)
			{
				if($request_new_password == $request_conf_password)
				{
					$update['password'] = md5($request_new_password);
					DB::table(TBL_USER)->where('user_id',session()->get('admin_id'))->update($update);
					session()->flash('success','Password has been changed successfully.'); 
					return redirect('admin-change-password');
				}
				else
				{
					session()->flash('error','Confirm password does not match.'); 
					return redirect('admin-change-password');
				}
			}
			else
			{
				session()->flash('error','Current password does not match.'); 
				return redirect('admin-change-password');
			}
		}
		return view('admin.change_password');
	}
}
