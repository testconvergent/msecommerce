<?php
namespace App\Image_lib;
use App\Http\Controllers\TestController;
class Image_libary
{
	public static function get_image($file,$type2,$desired_width,$desired_height,$file_loc,$uploade_path,$resize_path)
	{
		//$file=time().'-'.rand(10000,99999).'.'.$type2;
		move_uploaded_file($file_loc,$uploade_path.$file);
		$resize = $uploade_path.$file;
		//echo $resize;die;
		
		
		//$type = $_FILES['image']['type'];
       if(($type2== 'jpeg' || $type2== 'jpg') )
       {
			$source_image = imagecreatefromjpeg($resize);
			$virtual_image = imagecreatetruecolor($desired_width, $desired_height);	
       }
       else if(($type2== 'png'))
       {
			$source_image = imagecreatefrompng($resize);
			$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
			$kek=imagecolorallocate($virtual_image, 255, 255, 255);
			imagefill($virtual_image,0,0,$kek);
       }
       else 
       {
       $source_image = imagecreatefromgif($resize);
       }
       $width = imagesx($source_image);
       $height = imagesy($source_image);	
       /* find the "desired height" of this thumbnail, relative to the desired width  */
       /* create a new, "virtual" image */
       //$virtual_image = imagecreatetruecolor($desired_width, $desired_height);	
       /* copy source image at a resized size */
       imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
       /* create the physical thumbnail image to its destination */
       imagejpeg($virtual_image, $resize_path.$file);
	   
	   
	   
	   
	   
		
		
	}
}
?>