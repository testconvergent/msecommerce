<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
class SearchController extends Controller
{
	public function index(Request $request,$any1="",$any2=""){
		if(@$any1){			
		$getAllCategoryDetails=DB::table(TBL_CATEGORY_MASTER)
								->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug as category_slug')
								->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
								->where(TBL_CATEGORY_MASTER.'.parent_id',0)
								->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
								->where('parent_id',0)
								->where('category_status',1)
								->get();
			
		$getSeletedCategoryDetails = DB::table(TBL_CATEGORY_MASTER)
											->where('category_slug',$any1)
											->where('category_status',1)
											->first();
		$selectedCateGoryId=$getSeletedCategoryDetails->category_master_id;			
			//get all subcategory of that category
		$getAllSubCategoryDetails=DB::table(TBL_CATEGORY_MASTER)
									->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name',TBL_CATEGORY_MASTER.'.category_slug as sub_category_slug')
									->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
									->where(TBL_CATEGORY_MASTER.'.parent_id',$selectedCateGoryId)
									->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
									->get();
		}
		if(@$any1 && @$any2){
		$getSelectedSubCategoryDetails = DB::table(TBL_CATEGORY_MASTER)
										->where('category_slug',$any2)
										->where('category_status',1)
										->first();
		$selectedSubCateGoryId=$getSelectedSubCategoryDetails->category_master_id;
		}
		$selectedSubCateGoryId=isset($selectedSubCateGoryId)?$selectedSubCateGoryId:null;
           ///////////////////////////////////////////////////////////////////////////////////////////////////
		$product_filter = DB::table(TBL_PRODUCT);
		$product = $product_filter->select(TBL_PRODUCT.'.*','cat1.category_id as parent_cat','cat2.category_id as sub_cat','cat_des_1.category_name as parent_cat_name','cat_des_2.category_name as sub_cat_name',TBL_PRODUCT_TO_IMAGE.'.product_image')
								->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
								->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')
								->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_1','cat1.category_id','=','cat_des_1.category_master_id')
								->leftJoin(TBL_CATEGORY_DESCRIPTION.' as cat_des_2','cat2.category_id','=','cat_des_2.category_master_id')
								->leftJoin(TBL_PRODUCT_TO_IMAGE,TBL_PRODUCT.'.product_id','=',TBL_PRODUCT_TO_IMAGE.'.product_id')
								->where('cat_des_1.language_id',1)
								->where('cat_des_2.language_id',1)
								->where('cat1.category_lavel',1)
								->where('cat2.category_lavel',2)
								->groupBy(TBL_PRODUCT_TO_IMAGE.'.product_id')
								->where(TBL_PRODUCT.'.product_status',1);
			if(@$any1){
				$product = $product_filter->where('cat1.category_id',$selectedCateGoryId);
			}
			if(@$any1 && @$any2){
					$product = $product_filter->where('cat1.category_id',$selectedCateGoryId);
					$product = $product_filter->where('cat2.category_id',$selectedSubCateGoryId);
			}
			$request_option_value_array=array();
        ///////////////////////////////////////////////////////////////////////////////////////////////////
			//dd($request->all());
		if(@$request->all()){			
			if(@$request->short){				
			if($request->short == "low"){
					$product = $product_filter->orderby(TBL_PRODUCT.'.product_price','desc');
				}
				elseif($request->short == "high"){
					$product = $product_filter->orderby(TBL_PRODUCT.'.product_price','asc');
				}
			}			
			if(@$request->max_price){				
				$product = $product_filter->where(TBL_PRODUCT.'.product_price','>=',$request->min_price);
				$product = $product_filter->where(TBL_PRODUCT.'.product_price','<=',$request->max_price);
			}
			$count_product = $product_filter->get();
////////////////////product option value/////////////////////////////////////////////////////////
		 $productOptionMAsterDetails=DB::table(TBL_PRODUCT_OPTION_MASTER)
										->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
										->where('category_id',$request->sub_category)
										->where('language_id',1)
										->where('show_in_search',1)
										->where('parent_id',0)					
										->get();											
			$alias=3;
			foreach($productOptionMAsterDetails as $row){
						$tempArry=array();
						 $name=str_replace(' ','-',strtolower($row->option_name));
						if(array_key_exists($name, $request->all()) && @$request->{$name}){
							if(is_array($request->{$name})){
								foreach($request->{$name} as $val)
								array_push($request_option_value_array,$val);
								array_push($tempArry,$val);								
							}else{
									array_push($tempArry,$request->{$name});
									array_push($request_option_value_array,$request->{$name});
								}							
							$product->Join(TBL_PRODUCT_TO_PRODUCT_OPTION.' as cat'.($alias),'cat'.($alias).'.product_id','=',TBL_PRODUCT.'.product_id')
							->where('cat'.($alias).'.option_master_id',$row->option_master_id)
							->whereIn('cat'.($alias).'.option_detail_id',$request_option_value_array);
						$alias++;						
						$tempArry=array();
						}
			}
		
//////////////////////////////////////////////////////////////////////////////////////////			
		$product = $product->paginate(4);						 
	  }else{
			$product = $product_filter->orderby(TBL_PRODUCT.'.product_id','desc')->paginate(4);
			$count_product = DB::table(TBL_PRODUCT)->where('product_status',1)->get();
	  }
		if(App::getLocale()=='en'){			
			$total_category = DB::table(TBL_CATEGORY_MASTER)
									->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
									->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
									->where(TBL_CATEGORY_MASTER.'.parent_id',0)
									->where(TBL_CATEGORY_MASTER.'.category_status',1)
									->where(TBL_CATEGORY_DESCRIPTION.'.language_id',1)
									->get();
		}
		//for arabic
		if(App::getLocale()=='ar'){
			$fetch_category1 = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)->limit(5)
			->get();
			$fetch_category2 = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)->offset(5)->limit(50)
			->get();
			$fetch_sub_category1 = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id','!=',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)->limit(5)
			->get();
			$fetch_sub_category2 = DB::table(TBL_CATEGORY_MASTER)->select(TBL_CATEGORY_MASTER.'.category_master_id as category_id',TBL_CATEGORY_DESCRIPTION.'.category_name as cat_name')
			->leftJoin(TBL_CATEGORY_DESCRIPTION,TBL_CATEGORY_MASTER.'.category_master_id','=',TBL_CATEGORY_DESCRIPTION.'.category_master_id')
			->where(TBL_CATEGORY_MASTER.'.parent_id','!=',0)
			->where(TBL_CATEGORY_MASTER.'.category_status',1)
			->where(TBL_CATEGORY_DESCRIPTION.'.language_id',2)->offset(5)->limit(50)
			->get();
		}
		//for arabic
		
		
		$max_price = $product_filter->where('product_status',1)
									->orderby('product_price','desc')
									->first();
		$min_price = $product_filter->where('product_status',1)
									->orderby('product_price','asc')
									->first();
///////////////////////////////product option master///////////////////////////////////////////////////		
			$productOptionMAsterDetails=DB::table(TBL_PRODUCT_OPTION_MASTER)
												->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
												->where('category_id',$selectedSubCateGoryId)
												->where('language_id',1)
												->where('show_in_search',1)
												->where('parent_id',0)
												->get();
				
				foreach($productOptionMAsterDetails as $row){
					if($row->option_type_search_form==1) //single select
					{   $row->option_type_search='single select';
						$row->optionTypeValue=$this->getTheOptionValue($row->option_master_id);
					}
					if($row->option_type_search_form==2)   //multiselect
					{   $row->option_type_search='multi select';
						$row->optionTypeValue=$this->getTheOptionValue($row->option_master_id);
					}
				}
				
///////////////////////////////product option master/////////////////////////////////		
		$data = ['product'=>$product,
				'post_data'=>$request->all(),				
				'total_category'=>$getAllCategoryDetails,
				'total_subcategory'=>$getAllSubCategoryDetails,
				'selected_category_id'=>$selectedCateGoryId,
				'selected_sub_category_id'=>$selectedSubCateGoryId,
				'request_option_value_array'=>$request_option_value_array,			
				'max_price'=>$max_price,
				'searching_string'=>'',
				'min_price'=>$min_price,
				'count'=>$product,
				'product_option_details'=>$productOptionMAsterDetails,
				'cat_bread_cum'=>ucwords(str_replace('-',' ',$any1)),
				'cat_url'=>url('search/'.$any1),
				'base_url'=>url(''),
				'sub_cat_bread_cum'=>ucwords(str_replace('-',' ',$any2))
				];
//dd($data);				
		if(App::getLocale()=='en'){
			return view('english.search_product',$data);
		}
		if(App::getLocale()=='ar'){
			return view('arabic.search_product',$data);
		}
	
	}
	public function getTheOptionValue($product_option_master_id){		
			$productOptionMAsterValueDetails=DB::table(TBL_PRODUCT_OPTION_MASTER)
												->leftJoin(TBL_PRODUCT_OPTION_DETAIL,TBL_PRODUCT_OPTION_MASTER.'.option_master_id','=',TBL_PRODUCT_OPTION_DETAIL.'.option_master_id')
												->where('language_id',1)
												//->where('show_in_search',1)
												->where('parent_id',$product_option_master_id)
												->get();
			return $productOptionMAsterValueDetails;
	}			
	public function add_to_favorite(Request $request){
		//echo $request->product_id;die;
		$product_id = $request->product_id;
		$fetch = DB::table(TBL_ADD_TO_FAVORITE)->where('user_id',session()->get('user_id'))->where('product_id',$product_id)->first();
		if(count($fetch)>0){
			DB::table(TBL_ADD_TO_FAVORITE)->where('favorite_id',$fetch->favorite_id)->delete();
			$response=array('msg'=>2);
		}else{
			$insert = array();
			$insert['product_id'] = $product_id;
			$insert['user_id'] = session()->get('user_id');
			DB::table(TBL_ADD_TO_FAVORITE)->insert($insert);
			$response=array('msg'=>1);
		}
		//$response=array('product_id'=>$request->product_id,'_token'=>$request->_token);
		echo json_encode($response);
	}
	public function autocomplete_search(Request $request ){		
		$searching_data=$request->value;
		if(@$searching_data){	
		$details=DB::table(TBL_PRODUCT)
					->select('*')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')									
					->leftJoin(TBL_CATEGORY_MASTER.' as cat_mas','cat2.category_id','=','cat_mas.category_master_id')					
					->where(TBL_PRODUCT.'.product_status',1); //for active product
			
		$catObj=$details->where('category_slug','LIKE','%'.$searching_data.'%')
					->where('cat_mas.parent_id',0)
					->groupBy('cat1.category_id')
					->get();
		
		
		$category_slug='';
		if(count($catObj)){	
		$category_slug=$catObj[0]->category_slug;
		}	
				$subCatObj=DB::table(TBL_PRODUCT)
					->select('*')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')									
					->leftJoin(TBL_CATEGORY_MASTER.' as cat_mas','cat2.category_id','=','cat_mas.category_master_id')					
					->where(TBL_PRODUCT.'.product_status',1);
		if(count($catObj))$subCatObj->where('cat1.category_id',$catObj[0]->category_id);	
		else $subCatObj->where('category_slug','LIKE','%'.$searching_data.'%');	
			$subCatObj=	$subCatObj->where('cat2.category_lavel',2)
					->groupBy('cat2.category_id')
					->get();			
		$arrOfSub=array();
			$data_sub=array();
			$data_sub_mas=array();
		if(count($subCatObj)){
						
		foreach($subCatObj as $row){
			if(count($data_sub)<5){	
				if(!@$category_slug)$category_slug=$this->getCategorySlug($row->category_id);
				$url=url('search/'.$category_slug.'/'.$row->category_slug);
				$data_sub[]='<li><div data-link="'.$url.'">'.strtolower($row->category_slug).' in <span class="main_cat">'.$row->category_slug.'s</span></div></li>';	
				$arrOfSub[]=$row->category_id;
				$data_sub_mas[]=strtolower($row->category_slug);
				}
			}
		}
			
			$prodObj=DB::table(TBL_PRODUCT)
					->select('*')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat1',TBL_PRODUCT.'.product_id','=','cat1.product_id')
					->leftJoin(TBL_PRODUCT_TO_CATEGORY.' as cat2',TBL_PRODUCT.'.product_id','=','cat2.product_id')									
					->leftJoin(TBL_CATEGORY_MASTER.' as cat_mas','cat2.category_id','=','cat_mas.category_master_id')				
					->where(TBL_PRODUCT.'.product_status',1); //for active product
			if(count($subCatObj)) $prodObj->whereIn('cat1.category_id',$arrOfSub);
			else $prodObj->where('product_title','LIKE','%'.$searching_data.'%');
					//->where('product_title','LIKE','%'.$searching_data.'%')					
				$prodObj=$prodObj->where('cat_mas.parent_id','<>',0)
					->groupBy('cat1.product_id')
					->get();
			$data_prod=array();
			$data_prod_mas=array();	
		if(count($prodObj)){
			foreach($prodObj as $row){
				if(count($data_prod)<5){
				$url=url('product/'.$row->product_slug);
				$data_prod[]='<li><div data-link="'.$url.'">'.$row->product_title.' in <span class="main_cat">'.$row->category_slug.'</span></div></li>';	
				$data_prod_mas[]=$row->product_title;
				}				
			}
		
		$result = array_merge($data_prod, $data_sub);		
		$result_master = array_merge($data_prod_mas, $data_sub_mas);		
		$result=join(' ',$result);
		}
		if(@$result)return array('status'=>"success",'data'=>'<ul>'.$result.'<ul>','masterData'=>$result_master);
		else return array('status'=>"fail");
		}
	}	
	public function getCategorySlug($getCatId){
		$getSubCatSlug=DB::table(TBL_CATEGORY_MASTER)
				->where('category_master_id',$getCatId)
				->where('category_status',1)
				->first();
	   $getCatSlug=DB::table(TBL_CATEGORY_MASTER)
				->where('category_master_id',$getSubCatSlug->parent_id)
				->where('category_status',1)
				->first();
		return $getCatSlug->category_slug;
				
	}
}