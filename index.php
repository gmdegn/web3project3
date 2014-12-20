<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<meta name="robots" content="noindex">
<meta charset="UTF-8">
<title>EDMarket</title>

</head>

<body>
<div id='header'><font color='red'>EDM</font>arket <a href="checkout.php">My Cart</a>
<form method='POST' action='#'><input type='text' name='srch'><input type='submit' value='search'></form>
</div>
<?php
$servername = "localhost";
$username ='root';
$password = 'Zaqwedc1';
$message = '';
$updateVal = false;
$conn = new mysqli($servername, $username, $password);

if(isset($_POST['srch'])){
	$searched = $_POST['srch'];
}
else {
	$searched = 'any';
}

if(isset($_POST['clear'])){unset($_SESSION['purch']);}

if(isset($_POST['id'])){
	if(!isset($_SESSION['purch'])){
		$_SESSION['purch'] = array();
	}
	if(!isset($_SESSION['qty'])){
		$_SESSION['qty'] = array();
	}
	array_push($_SESSION['purch'], $_POST['id']);
	array_push($_SESSION['qty'], $_POST['qty']);
	$updateVal = true;
	$message = 'ADDED TO CART!';
}


	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if($conn->select_db('edmarket') === false) {
		echo "Please set up database in admin page!";
	}
	else{
		$res = mysqli_query($conn, "SHOW TABLES LIKE 'music'");
		if (mysqli_num_rows($res) > 0){

			$conn->select_db('edmarket') or die("WHOOPS");
			if($updateVal){
				$sql = 'UPDATE music SET qavail = qavail - '.$_POST['qty'].' WHERE id = '.$_POST['id'];
				if ($conn->query($sql) === FALSE) {
					echo "Error!: " . $conn->error;
				}
			}
			$sql = "SELECT * FROM music";
			$result = mysqli_query($conn, $sql);
			
			$id = array();
			$band = array();
			$album = array();
			$fmat = array();
			$notes = array();
			$price = array();
			$avail = array();
			$albart = array();
			$x = 0;
			echo '<div id="containter">';
			while($row = mysqli_fetch_array($result)) {
				$id[$x] = $row['id'];
				$band[$x] = $row['artist'];
				$album[$x] = $row['album'];
				$fmat[$x] = $row['format'];
				$notes[$x] = $row['des'];
				$price[$x] = $row['price'];
				$avail[$x] = $row['qavail'];
				$albart[$x] = $row['albart'];
				if($band[$x] == $searched || $searched == 'any'){
					echo "<div class='cd'>";
					echo "<img src='" . $albart[$x] . "' width='100px'><br>";
					echo $band[$x] . ": ";
					echo $album[$x] . "<br>";
					echo "<span><hr>Format: " . $fmat[$x] . "<br>";
					echo $notes[$x] . "</span><hr>";
					echo "$" . $price[$x] . "<br>";
					echo "<strong># In Stock: </strong>" . $avail[$x];
					echo "<br><form method='POST' action='#'>
					<input type='hidden' name='id' value='$id[$x]'>
					<input type='number' name='qty' max='$avail[$x]' min='0' value='";
					if($avail[$x] == 0){echo "0'>";} else {echo "1'>";}
					echo"<input type='submit' value='";
					if($avail[$x]==0){echo "Sold Out!' disabled>";}else{echo "BUY'>";}
					echo "</form>";
					if(isset($_POST['id'])){
						if($_POST['id'] == $id[$x]){
							echo "<br>".$message;
						}
					}
					echo "</div>";
				}
				$x++;
			}
			/* For Dev
			echo "<br><br>";
			if(isset($_SESSION['purch'])){
				var_dump($_SESSION['purch']);
			}
			echo "<br><form method='POST' action='#'>
			<input type='hidden' name='clear' value='true'>
			<input type='submit' value='Clear Session Data'></form>";
			*/
		}
		else{
			echo "No Music Available";
		}
	}
	$conn->close();
?>
</body>

</html>