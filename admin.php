<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="robots" content="noindex">
<title>EDMarket - Admin</title>

</head>

<body>

<?php
	if(!isset($_SESSION['logged'])){
		if(isset($_POST['passW'])){
			if ($_POST['passW'] == 'Zaqwedc1' && $_POST['uName'] == 'root'){
				$wrong = false;
				$_SESSION['passW'] = $_POST['passW'];
				$_SESSION['uName'] = $_POST['uName'];
				$_SESSION['logged'] = true;
			}
			else {
				$wrong = true;
				$message = 'You have entered an incorrect login!';
			}
		}
		else {
			$wrong = true;
			$message = '';
		}

		if($wrong == true){
			echo "<div style='text-align:center;'>
				<strong style='color:red;'>". $message ."</strong>
				<br><br><br>
				<form method='POST' action='#'>
					Username: <input type='text' name='uName'>
					<br><br>
					Password: <input type='password' name='passW'>
					<br><br>
					<input type='submit' value='Log In'>
				</form></div>
			";
		}
	}
	else {
		echo "<div style='text-align:center;'>LOGIN SUCCESSFUL!</div><br><br>";
		$servername = "localhost";
		$username = $_SESSION['uName'];
		$pass = $_SESSION['passW'];
		
		$conn = new mysqli($servername, $username, $pass);
		
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if($conn->select_db('edmarket') === false) {
		$sql = "CREATE DATABASE edmarket";
		if ($conn->query($sql) === TRUE) {
			echo "Database created successfully";
			sleep(5);
			header("Location:admin.php");
		} else {
			echo "Error creating database: " . $conn->error;
		}
	}
	else{
		$res = mysqli_query($conn, "SHOW TABLES LIKE 'music'");
		if (mysqli_num_rows($res) > 0){
		
			if(isset($_POST['art'])){
				if(!isset($_POST['art'])){$art = '';}else{$art = str_replace('\'','\"\'\"',$_POST['art']);}
				if(!isset($_POST['alb'])){$alb = '';}else{$alb = str_replace('\'','\"\'\"',$_POST['alb']);}
				if(!isset($_POST['fmat'])){$fmat = '';}else{$fmat = $_POST['fmat'];}
				if(!isset($_POST['note'])){$note = '';}else{$note = str_replace('\'','\"\'\"',$_POST['note']);}
				if(!isset($_POST['prc'])){$prc = '';}else{$prc = $_POST['prc'];}
				if(!isset($_POST['qa'])){$qa = '';}else{$qa = $_POST['qa'];}
				if(!isset($_POST['albart'])){$albart = 'images/cddefault.png';}else{$albart = $_POST['albart'];}
				$sql = "INSERT INTO music (artist, album, format, des, price, qavail, albart)
				VALUES ('$art', '$alb', '$fmat', '$note', '$prc', '$qa', '$albart')";
				if ($conn->query($sql) === TRUE) {
					echo "Record added successfully";
					sleep(5);
					header("Location:admin.php");
				} else {
					echo "Error: " .$conn->error;
				}
			}
		
			echo "<div style='text-align:left; width:20%; margin-left:auto; margin-right:auto;'>
				<strong>Add an Album:</strong><br><hr><form method='POST' action='#'>
					Artist: <input type='text' name='art' required><br>
					Album: <input type='text' name='alb' required><br>
					Format: <select name='fmat'>
							<option value='cd' selected='selected'>CD</option>
							<option value='cs'>CS</option>
							<option value='lp'>LP</option>
						</select><br>
					Description: <textarea name='note' rows='5' cols='40' maxlength='160' placeholder='Enter notes here.' style='overflow:auto;resize:none'></textarea><br>
					Price: <input type='number' step='any' name='prc' min='1' required><br>
					Quantity Available: <input type='number' name='qa' min='0' required><br>
					Album Art: <input type='file' name='albart'><br><br>
					<input type='submit' value='Submit'>
				</form></div>
			";
		
		}
		else{
			$sql = "CREATE TABLE music (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			artist VARCHAR(30),
			album VARCHAR(30),
			format VARCHAR(3),
			des VARCHAR(160),
			price DECIMAL(10,2),
			qavail INT(4),
			albart VARCHAR(50)
			)";
			
			if ($conn->query($sql) === TRUE) {
				echo "Table music created successfully";
				sleep(5);
				header("Location:admin.php");
			} else {
				echo "Error creating table: " .$conn->error;
			}
		}
	}
	$conn->close();
	}
?>

</body>

</html>