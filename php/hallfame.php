<html>
	<head>
		<title>Hall Of Fame</title>
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
		
		$servername = 'localhost';
		$username = 'id3110622_hshibuya96';
		$password = '0511myh77';
		$dbname = 'id3110622_paintings';

		$connection = new mysqli($servername, $username, $password, $dbname);
		
		$sql = 'SELECT pid, name, title, desc, pdate, comment FROM paintings INNER JOIN approved ON paintings.pid=approved.pid';
		$results = connection->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				genDiv($row);
			}
			
		
		?>
		
		
	</body>
</html>