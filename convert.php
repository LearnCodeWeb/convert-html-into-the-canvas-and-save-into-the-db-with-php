<?php include_once('config.inc.php');
if(isset($_REQUEST['saveImage']) and $_REQUEST['saveImage']!=""){
	extract($_REQUEST);
	$imageName	=	rand(0,9999).time();
	$mimeType	=	str_replace("data:image/","",explode(";",$_POST['imgCanvas']));
	
	if(strtolower($mimeType[0])=="png"){
		$image	=	imagecreatefrompng($_POST['imgCanvas']);
		imagealphablending($image, false);
		imagesavealpha($image, true);
		header("Content-Type: image/png");
		imagepng($image, 'uploads/'.$imageName.'.'.$mimeType[0]);
	}elseif(strtolower($mimeType[0])=="jpeg" || strtolower($mimeType[0])=="jpg"){
		$image	=	imagecreatefromjpeg($_POST['imgCanvas']);
		imagealphablending($image, false);
		imagesavealpha($image, true);
		header("Content-Type: image/jpeg");
		imagejpeg($image, 'uploads/'.$imageName.'.'.$mimeType[0]);
	}
	
	$data	=	array(
					'file_name'=>$imageName,
					'file_path'=>'uploads/'.$imageName,
					);
	
	$db->insert('html_to_image',$data);
	
	echo '<div class="alert alert-success"><i class="fa fa-fw fa-thumbs-up"></i> Image updated successfully <strong>Please wait...!</strong></div>|***|1';
}
?>