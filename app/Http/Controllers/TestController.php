<?php
namespace App\Http\Controllers;
use DB;
use App;
use Illuminate\Http\Request;
use App\Image_lib\Image_libary;
class TestController extends Controller
{
    public function index(Request $request)
    {
		if($request->all()){
			$file = $_FILES['image']['name'];
			$type=explode('.',$_FILES['image']['name']);
			$type1 = $type[0];
			$type2 = $type[1];
			$width = 200;
			$height = 100;
			//echo $type1;die;
			$file_loc = $_FILES['image']['tmp_name'];
			/* $file_size = $_FILES['image']['size'];
			$file_type = $_FILES['image']['type'];
			$type=explode('.',$_FILES['image']['name']);
			$type1=end($type); */
			$uploade_path="upload/";
			$resize_path="upload/thumb/";
			Image_libary::get_image($type1,$type2,$width,$height,$file_loc,$uploade_path,$resize_path);
		}
		return view('image');
	}
}
