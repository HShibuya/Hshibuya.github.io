<?php
echo "here <br/>";
$img_dir = '/storage/ssd1/622/3110622/public_html/paint_queue';
//$img_dir = '/Users/HirokiShibuya/Sites/Personal Webpage/paint_queue';
$file_count = 0;
$paintings = glob($img_dir.'/*');
if($paintings){
	$file_count = count($paintings);
}

$added = print_r($_POST);
echo "$added <br/>";
$imgData = $_POST['imageurl'];
echo "$imgData <br/>";
$imgData = substr($imgData,strpos($imgData,",")+1);
$imgData = str_replace(' ', '+', $imgData);
echo "pre ".$imgData." <br/>";
$img = base64_decode($imgData);
echo "final ".$img." <br/>";

$filename = $img_dir.'/'.$file_count.'.png';
echo chmod($img_dir,0755);

echo "$filename<br/>";

$success = file_put_contents($filename, $img);

?>