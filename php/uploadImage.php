<?php

function debug($data){
	$print = $data;
	echo "<script>console.log('$print')<\script>";
}

$img_dir = '../paintings';
$file_count = 0;
$paintings = glob($img_dir.'/*');
if($paintings){
	$file_count = count($paintings);
}

$imgData = $_POST['imageurl'];
$name = 'unknown';
$secret = 'unknown';
$title = 'untitled';
$desc = 'no description';
if(isset($_POST['name'])){
	$name = $_POST['name'];
}
if(isset($_POST['secret'])){
	$secret = $_POST['secret'];
}
if(isset($_POST['title'])){
	$title = $_POST['title'];
}
if(isset($_POST['description'])){
	$desc = $_POST['description'];
}

$imgData = substr($imgData,strpos($imgData,",")+1);
$imgData = str_replace(' ', '+', $imgData);
$img = base64_decode($imgData);

$fileData = ''.$file_count.$date.$name.$secret.$title;

$fileHash = hash('sha256', $fileData);
$filename = $img_dir.'/'.$fileHash.'.png';

$success = file_put_contents($filename, $img);



$servername = 'localhost';
$username = 'id3110622_hshibuya96';
$password = 'boort7467';
$dbname = 'id3110622_paintings';

$connection = new mysqli($servername, $username, $password, $dbname);


if ($connection->connect_error) {
	echo("Connection failed: ".$connection->connect_error."\n");
};


$sql = "INSERT INTO paintings (pid, name, secret, title, descr, pdate) VALUES ('$fileHash', '$name', '$secret', '$title','$desc', CURRENT_TIMESTAMP)";

/*
try{
	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	try{
		$connection->exec($sql);
		echo "New record created successfully";
	}
	catch(PDOException $e){
		echo "No record created: ".$e->getMessage();
	}
}
catch(PDOException $e){
	echo "Connection failed: ".$e->getMessage();
}
*/



//MySqli

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: ".$sql."<br>".$connection->error;
}




