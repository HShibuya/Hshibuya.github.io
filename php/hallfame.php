<html>
	<head>
		<title>Hall Of Fame</title>
		<link rel="stylesheet" type="text/css" href="../css/hall.css">
	</head>
	<body>
		<script type="text/javascript">
			
			//function to fill in the modal HTML for clicked painting
			function showDesc(pid,name,title,descr,date,comment){
				$('#showDesc').style.display='block';
				$('#imageUp').attr('src','paintings/'+pid+'.png');
				$('#title').html(title);
				$('#nameUp').html('By: '+name);
				$('#desc').html(descr);
				$('#comment').html(comment);
				$('#date').html(date);
			}
		</script>
		
		<!-- Modal HTML that appears when a painting is clicked -->
		
		<div id='background'>
			<div id="showDesc">
				<span id="close" class="close" onclick="$(#showDesc).style.display='none'">&times;</span>
				<div class="imgcontainer">
					<h3 id='title'></h3>
					<img id='imageUp'/>
				</div>
				<div id='descContainer' class="container">
					<p id='nameUp'></p>
					<p id='date'></p>
					<label for='desc'>A Little Bit About This Piece:</label>
					<p id='desc'></p>
					<label for='comment'>My Comments!</label>
					<p id='comment'></p>
				</div>
			</div>
		</div>
		
		
		<?php
		function genDiv($row){
			$pid = $row['pid'];
			$name = $row['name'];
			$title = $row['title'];
			$desc = $row['descr'];
			$date = $row['pdate'];
			$comment = $row['comment'];
			
			$html = "<div id='$pid'' class='painting' onclick='showDesc('$pid','$name','$title','$descr','$date','$comment')'>
				<p class='title'>$title</p>
				<img src='paintings/$pid".".png'>
				<p class='name'><i>By: $name</i></p>";
			echo $html;
		}
		
		//$servername = 'localhost';
		$servername = 'localhost';
		$username = 'id3110622_hshibuya96';
		$password = 'boort7467';
		$dbname = 'id3110622_paintings';

		$connection = new mysqli($servername, $username, $password, $dbname);
		//$connection = new mysqli($servername);
		
		if ($connection->connect_error) {
			echo("<script>console.log('Connection failed: ".$connection->connect_error."')</script>");
		} 
		else{
			echo("<script>console.log('Connection successful')</script>");
		}
		
		//$sql = 'SELECT pid, name, title, desc, pdate, comment FROM paintings INNER JOIN approved ON paintings.pid=approved.pid';
		$sql = 'SELECT pid FROM paintings;';
		$results = $connection->query($sql);
		echo "<script>console.log('".$results."')</script>";
		if ($result->num_rows > 0) {
			echo("<script>console.log('Query successful')</script>");
			// output data of each row
			while($row = $result->fetch_assoc()) {
				genDiv($row);
			}
		}
		else{
			echo "<script>console.log('Error: ".$sql."');console.log('".$connection->errno."')</script>;";
		}
			
		
		?>
		
		
	</body>
</html>