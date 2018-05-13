<html>
	<head>
		<title>Hall Of Fame</title>
		<link rel="stylesheet" type="text/css" href="../css/hall.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>
		
		<!-- Modal HTML that appears when a painting is clicked -->
		
		<div id='background'>
			<div id="zoom">
				<span id="close" class="close" onclick="$('#background').css('display','none')">&times;</span>
				<img id='imageUp'/>
				<div class='plaque'>
					<h3 id='titleUp'></h3>
					<div id=artistContainer>
						<p id='nameUp'></p>
						<p id='dateUp'></p>
					</div>
				</div>
				<div id='descContainer'>
					<label for='desc'>A Little Bit About This Piece:</label>
					<p id='desc' class="desc"></p>
					<label for='comments'>My Comments!</label>
					<p id='comments' class='desc'></p>
				</div>
			</div>
		</div>
		
		<div id='gallery'>
			<?php
			function genDiv($row){
				$pid = $row["pid"];
				$name = $row["name"];
				$title = $row["title"];
				$desc = $row["descr"];
				$date = $row["only_date"];
				$comment = $row["comments"];

				$functStr = "showDesc('".$pid."','".$name."','".$title."','".$desc."','".$date."','".$comment."')";

				$html = '<div id="'.$pid.'" class="painting" onclick="'.$functStr.'">
					<img class= "drawing" src="../paintings/'.$pid.'.png">
					<p class="title" style="font-size:24px;">'.$title.'</p>
					<p class="name" style="font-size:16px;"><i>By: '.$name.'</i></p>
				</div>';
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

			$sql = 'SELECT paintings.pid, name, title, descr, DATE(pdate) AS only_date, comments FROM paintings INNER JOIN approved ON paintings.pid=approved.pid ORDER BY pdate';
			$results = $connection->query($sql);
			if ($results->num_rows > 0) {
				echo("<script>console.log('Query successful')</script>");
				// output data of each row
				while($row = $results->fetch_assoc()) {
					genDiv($row);
				}
			}
			else{
				echo '<script>console.log("Error: '.$sql.'");console.log("'.$connection->error.'")</script>;';
			}


			?>



			<script type="text/javascript">

				//function to fill in the modal HTML for clicked painting
				function showDesc(pid,name,title,descr,date,comment){

					$('#background').css('display','block');
					$('#imageUp').attr('src','../paintings/'+pid+'.png');
					$('#titleUp').html(title);
					$('#nameUp').html('<i>By: '+name+'</i>');
					$('#desc').html('<i>'+descr+'</i>');
					$('#comments').html('<i>'+comment+'</i>');
					$('#dateUp').html(date);
			</script>
			
		</div>
		
	</body>
</html>