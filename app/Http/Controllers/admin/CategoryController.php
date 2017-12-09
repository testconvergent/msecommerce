<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request){
		DB::enableQueryLog();
		$post_data = $request->all();
		$fetch_cat = DB::table(TBL_CATEGORY_MASTER);
		$fetch = $fetch_cat->select(TBL_CATEGORY_MASTER.'.*',TBL_CATEGORY_DESCRIPTION.'.category_name as category_name',TBL_CATEGORY_DESCRIPTION.'.*')
					->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
					->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
					->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)
					->orderBy('display_order','asc');
		if(@$post_data){
			if(@$request->status){
				if($request->status == 4){
					$status = 0;
				}
				else{
					$status = $request->status;
				}
			  $fetch = $fetch_cat->where(TBL_CATEGORY_MASTER.'.category_status',$status);
			}
			if(@$request->keyword){
				$fetch =$fetch_cat->where(TBL_CATEGORY_DESCRIPTION.'.category_name','like','%'.$request->keyword.'%');
			}
			if(@$request->category){
				$fetch = $fetch_cat->where(function($where) use ($request){
					      $where->where(TBL_CATEGORY_MASTER.'.category_master_id',$request->category)
						  ->orWhere(TBL_CATEGORY_MASTER.'.parent_id',$request->category);
				});
			}
			$fetch = $fetch_cat->paginate(25);
			$query = DB::getQueryLog();
			//echo '<pre>'; 
			//print_r($fetch); die;
		}else{
			$fetch = $fetch_cat->paginate(25);
			//echo '<pre>'; 
			//print_r($fetch); die;
		}
		//echo "<pre>";
		//print_r($query);//die;
		//print_r($fetch); die;
		
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
						->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
						->where(TBL_CATEGORY_MASTER.'.parent_id',0)
						->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
						->where(TBL_CATEGORY_MASTER.'.category_status','<>',3)
						->orderBy('display_order','asc')
						->get();
		
		$data = ['category'=>$fetch,'get_parent'=>$fetch_category,'post_data'=>$request->all()];
		return view('admin.category_list',$data);
    }
	public function add_category(Request $request){
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)
							->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name','display_order')
							->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
							->where(TBL_CATEGORY_MASTER.'.parent_id',0)
							->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
							->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)
							->orderBy('display_order','asc')
							->get();		
		$language = DB::table(TBL_LANGUAGE)->get();
		$post_data=$request->all();
		if(@$post_data)
		{
			$check_cat_name = DB::table(TBL_CATEGORY_DESCRIPTION)
								->where('category_name',$request
								->category_name_e)
								->get();
			if(count($check_cat_name)>0){
				session()->flash('error','You have already added this category.');
				return redirect('admin-category-list');
			}
			$validation = array();
			if($request->hasFile('category_icon')){
				$validation['category_icon']='required|image|mimes:jpeg,png,PNG,jpg|max:2048|dimensions:width=18,height=18';
			}
			$this->validate($request,$validation);
			$insert_master = array();
			if(@$request->category){
				$insert_master['parent_id'] = $request->category;
			}else{
				$insert_master['parent_id'] = 0;
			}
			//$insert_master['category_status'] = 1;
			$insert_master['display_order'] = $request->display_order;
			$slug=str_replace(' ','-',strtolower($request->category_name_e));
			$slug=str_replace('--','-',$slug);
			$insert_master['category_slug']=$slug;
			if($request->hasFile('category_icon')){
				$filename=time().".".$request->category_icon->getClientOriginalExtension();
				$request->category_icon->storeAs('public/category_image',$filename);
				$insert_master['category_icon'] = $filename;
			}
			$insert_id = DB::table(TBL_CATEGORY_MASTER)->insertGetId($insert_master);
			$inset_cat_e =array();
			$inset_cat_e['category_master_id']= $insert_id;
			$inset_cat_e['category_name']= $request->category_name_e;
			$inset_cat_e['category_meta_title']= $request->category_meta_title_e;
			$inset_cat_e['category_meta_description']= $request->category_meta_description_e;
			$inset_cat_e['language_id']= 1;
			DB::table(TBL_CATEGORY_DESCRIPTION)->insert($inset_cat_e);
			$inset_cat_a =array();
			$inset_cat_a['category_master_id']= $insert_id;
			$inset_cat_a['category_name']= $request->category_name_a;
			$inset_cat_a['category_meta_title']= $request->category_meta_title_a;
			$inset_cat_a['category_meta_description']= $request->category_meta_description_a;
			$inset_cat_a['language_id']= 2;
			DB::table(TBL_CATEGORY_DESCRIPTION)->insert($inset_cat_a);
			session()->flash('success','Category added successfully');
			return redirect('admin-category-list');
		}
		$data = ['category'=>$fetch_category,'language'=>$language];
		return view('admin.add_category',$data);
	}
	public function edit_category(Request $request,$id){
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
		->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
		->where(TBL_CATEGORY_MASTER.'.parent_id',0)->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)->where(TBL_CATEGORY_MASTER.'.category_status','!=',3)->get();
		
		$get_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.*',TBL_CATEGORY_DESCRIPTION.'.*')
		->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
		->where(TBL_CATEGORY_MASTER.'.category_master_id',$id)->get();
		//echo "<pre>";print_r($get_category);die;
		$first_id = $get_category[0]->id;
		$second_id = $get_category[1]->id;
		$language = DB::table(TBL_LANGUAGE)->get();
		$post_data=$request->all();
		if(@$post_data)
		{
			$check_cat_name = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.*',TBL_CATEGORY_DESCRIPTION.'.*')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_DESCRIPTION.'.category_name',$request->category_name_e)->where(TBL_CATEGORY_MASTER.'.category_master_id','!=',$id)->get();
			if(count($check_cat_name)>0)
			{
				session()->flash('error','You have already added this category.');
				return redirect('admin-category-list');
			}
			$validation = array();
			if($request->hasFile('category_icon'))
			{
				$validation['category_icon']='required|image|mimes:jpeg,png,PNG,jpg|max:2048|dimensions:width=18,height=18';
			}
			$this->validate($request,$validation);
			$insert_master = array();
			if(@$request->category)
			{
				$insert_master['parent_id'] = $request->category;
			}
			else
			{
				$insert_master['parent_id'] = 0;
			}
			//$insert_master['category_status'] = 1;
			$insert_master['display_order'] = $request->display_order;
			$slug=str_replace(' ','-',$request->category_name_e);
			$slug=str_replace('--','-',$slug);
			$insert_master['category_slug']=$slug;
			if($request->hasFile('category_icon'))
			{
				$filename=time().".".$request->category_icon->getClientOriginalExtension();
				$request->category_icon->storeAs('public/category_image',$filename);
				$insert_master['category_icon'] = $filename;
			}
			DB::table(TBL_CATEGORY_MASTER)->where(TBL_CATEGORY_MASTER.'.category_master_id',$id)->update($insert_master);
			$inset_cat_e =array();
			//$inset_cat_e['category_master_id']= $insert_id;
			$inset_cat_e['category_name']= $request->category_name_e;
			$inset_cat_e['category_meta_title']= $request->category_meta_title_e;
			$inset_cat_e['category_meta_description']= $request->category_meta_description_e;
			//$inset_cat_e['language_id']= 1;
			DB::table(TBL_CATEGORY_DESCRIPTION)->where(TBL_CATEGORY_DESCRIPTION.'.id',$first_id)->update($inset_cat_e);
			$inset_cat_a =array();
			//$inset_cat_a['category_master_id']= $insert_id;
			$inset_cat_a['category_name']= $request->category_name_a;
			$inset_cat_a['category_meta_title']= $request->category_meta_title_a;
			$inset_cat_a['category_meta_description']= $request->category_meta_description_a;
			//$inset_cat_e['language_id']= 2;
			DB::table(TBL_CATEGORY_DESCRIPTION)->where(TBL_CATEGORY_DESCRIPTION.'.id',$second_id)->update($inset_cat_a);
			session()->flash('success','Category edit successfully');
			return redirect('admin-category-list');
		}
		$data = ['category'=>$fetch_category,'get_cat'=>$get_category,'language'=>$language];
		return view('admin.edit_category',$data);
	}
	public function category_status($id){
		$fetch_cat = DB::table(TBL_CATEGORY_MASTER)->where('category_master_id',$id)->first();
		if($fetch_cat->category_status == 0)
		{
			$update = array('category_status' =>1);
		}
		else
		{
			$update = array('category_status' =>0);
		}
		DB::table(TBL_CATEGORY_MASTER)->where('category_master_id',$id)->update($update);
		session()->flash('success','Category status change successfully');
		return redirect('admin-category-list');
	}
	public function admin_multi_category_change_status(Request $request){		
		if(@$request->action=='Active' &&  @$request->category){
			$categoryArray=$request->category;
			DB::table(TBL_CATEGORY_MASTER)
				->whereIn('category_master_id',$categoryArray)
				->update(array('category_status'=>1));
			session()->flash('success','Category status change successfully');
			return redirect('admin-category-list');
		}elseif(@$request->action=='Inactive' && @$request->category){
			$categoryArray=$request->category;
			DB::table(TBL_CATEGORY_MASTER)
				->whereIn('category_master_id',$categoryArray)
				->update(array('category_status'=>0));
			session()->flash('success','Category status change successfully');
			return redirect('admin-category-list');
		}else{
			return redirect('admin-category-list');
		}
	}
	public function delete_category($id){
		$fetch_cat = DB::table(TBL_CATEGORY_MASTER)->where('parent_id',$id)->get();
		if(count($fetch_cat)>0)
		{
			session()->flash('error','You can not delete this category, because this category have sub category.');
			return redirect('admin-category-list');
		}
		else
		{
			$update = array('category_status'=>3);
			DB::table(TBL_CATEGORY_MASTER)->where('category_master_id',$id)->update($update);
			session()->flash('success','Category deleted successfully');
			return redirect('admin-category-list');
		}
	}
	public function sub_category(Request $request){
		$category = $request->category;
		$fetch_category = DB::table(TBL_CATEGORY_MASTER)
							->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
							->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
							->where(TBL_CATEGORY_MASTER.'.parent_id',$category)
							->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
							->get();
		$msg="";
		$msg.="<option value=''>Sub Category</option>";
		foreach($fetch_category as $cat)
		{
			$msg.="<option value=".$cat->category_id.">".$cat->cat_name."</option>";
		}
		echo $msg; 
	}
	public function admin_previous_category_display_order(Request $request){		
		if(!@$request->categoryId){			
			$categoryDetails=DB::table(TBL_CATEGORY_MASTER)			
							->where(TBL_CATEGORY_MASTER.'.parent_id',0)
							->where(TBL_CATEGORY_MASTER.'.category_status',1)
							->where(TBL_CATEGORY_MASTER.'.display_order',$request->displayOrder)
							->get();
			if(count($categoryDetails)){
				foreach($categoryDetails as $row){
					$category_slug[]=$row->category_slug;
				}
				return array('message'=>join(", ",$category_slug). ' has already been set.');
			}
		}else{
			 $categoryDetails=DB::table(TBL_CATEGORY_MASTER)			
							->where(TBL_CATEGORY_MASTER.'.parent_id',$request->categoryId)
							->where(TBL_CATEGORY_MASTER.'.category_status',1)
							->where(TBL_CATEGORY_MASTER.'.display_order',$request->displayOrder)
							->get();
			if(count($categoryDetails)){
				foreach($categoryDetails as $row){
					$category_slug[]=$row->category_slug;
				}
				return array('message'=>join(", ",$category_slug). ' has already been set.');
			}
		}
		
		
	}
}
