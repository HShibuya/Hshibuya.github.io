<?php
echo "here <br/>";

function debug($data){
	$print = $data;
	echo "<script>console.log('$print')<\script>";
}

debug('start');

$img_dir = '/storage/ssd1/622/3110622/public_html/paintings';
//$img_dir = '/Users/HirokiShibuya/Sites/Personal Webpage/paintings';
$file_count = 0;
$paintings = glob($img_dir.'/*');
if($paintings){
	$file_count = count($paintings);
}

$imgData = $_POST['imageurl'];
if(isset($_POST['name'])){
	$name = $_POST['name'];
}
else{
	$name = 'unknown';
}
if(isset($_POST['secret'])){
	$secret = $_POST['secret'];
}
else{
	$secret = 'unknown';
}
if(isset($_POST['title'])){
	$title = $_POST['title'];
}
else{
	$title = 'untitled';
}
if(isset($_POST['description'])){
	$desc = $_POST['description'];
}
else{
	$desc = 'no description';
}
$date = date(Y-m-d H:i:s);

$imgData = substr($imgData,strpos($imgData,",")+1);
$imgData = str_replace(' ', '+', $imgData);
$img = base64_decode($imgData);

$fileData = $file_count.$date.$name.$secret.$title;
$fileHash = hash('sha256', fileData);
$filename = $img_dir.'/'.$fileHash.'.png';
echo chmod($img_dir,0755);

echo "$filename<br/>";

$success = file_put_contents($filename, $img);



$servername = 'localhost';
$username = 'id3110622_hshibuya96';
$password = '0511myh77';
$dbname = 'id3110622_paintings';

$connection = new mysqli($servername, $username, $password);
$sql = "INSERT INTO paintings (pid, name, secret, descr, date) VALUES ($fileHash, $name, $secret, $desc, CURRENT_TIMESTAMP)";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

