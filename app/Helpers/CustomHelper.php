<?php
	function fetch_user($user_id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$user_id)->first();
		return $user;
	}
	function company_name($user_id)
	{
		$user = DB::table(TBL_USER)->where('user_id',$user_id)->first();
		//echo "<pre>";print_r($user);die;
		return $user;
	}
	function favorite($product_id)
	{
		$favorite = DB::table(TBL_ADD_TO_FAVORITE)->where('user_id',session()->get('user_id'))->where('product_id',$product_id)->first();
		return $favorite;
	}
	function category()
	{
		if(App::getLocale()=='en')
		{
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug',TBL_CATEGORY_MASTER.'.category_icon')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
			->get();
		}
		if(App::getLocale()=='ar')
		{
			$fetch_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
			->get();
		}
		//echo $fetch_category{0}->cat_name;die;
		
		
		return $fetch_category;
	}
	function sub_cat($catid)
	{
		if(App::getLocale()=='en')
		{
			$fetch_sub_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',$catid)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
			->get();
		}
		if(App::getLocale()=='ar')
		{
			$fetch_sub_category = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',$catid)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)
			->get();
		}
		return $fetch_sub_category;
	}
	function cart()
	{
		$fetch_cart_master = DB::table(TBL_CART_MASTER)->where('user_id',session()->get('user_id'))->first();
		return $fetch_cart_master;
	}
?>