<?php
echo "here <br/>";
$img_dir = '~/paint_queue';
$file_count = 0;
$paintings = glob($img_dir.'*');
echo "$file_count <br/>";
if($paintings){
	$file_count = count($paintings);
}
$file_count += 1;

$imgData = $_POST['imageurl'];
$imgData = substr($imgData,strpos($imgData,",")+1);
$imgData = str_replace(' ', '+', $imgData);
$img = base64_decode($imgData);
echo "$img <br/>";

$filename = $img_dir.'/'.$file_count.'.png';
chmod($img_dir,0755);

echo "$filename<br/>";

$success = file_put_contents($filename, $img);

echo "$success";

?>