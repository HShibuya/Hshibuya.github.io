<?php
echo "here <br/>";
$img_dir = 'paint_queue/';
$file_count = 0;
$paintings = glob($img_dir.'*');
echo "$file_count";
if($paintings){
	$file_count = count($paintings);
}
$file_count += 1;

echo $_POST['imageurl'];
$img = base64_decode($_POST['imageurl']);
file_put_contents($img_dir.$file_count.'png', img);

?>