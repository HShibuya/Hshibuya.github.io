<?php
echo "here <br/>";
$img_dir = '/storage/ssd1/622/3110622/public_html/paint_queue';
$file_count = 0;
$paintings = glob($img_dir.'/*');
if($paintings){
	$file_count = count($paintings);
}

$imgData = $_POST['imageurl'];
$imgData = substr($imgData,strpos($imgData,",")+1);
$imgData = str_replace(' ', '+', $imgData);
$img = base64_decode($imgData);

$filename = $img_dir.'/'.$file_count.'.png';
chmod($img_dir,0755);

echo "$filename<br/>";

$success = file_put_contents($filename, $img);

echo "$success";

?>