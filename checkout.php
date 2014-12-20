<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<meta charset="UTF-8">
<meta name="robots" content="noindex">
<title>EDMarket - Checkout</title>

</head>

<body>
	<?php
	$servername = "localhost";
	$username ='root';
	$password = 'Zaqwedc1';

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if($conn->select_db('edmarket') === false) {
		echo "Please set up database in admin page!";
	}
	$conn->select_db('edmarket') or die("WHOOPS");
	?>
	
	<?php
		if(isset($_POST['updt'])){
			$uarray = $_SESSION['qty'];
			$dat = $_POST['12updt'];
			$uarray[$dat] = $_POST['updt'];
			unset($_SESSION['qty']);
			$_SESSION['qty'] = array_values($uarray);
		}
	
		if(isset($_POST['id'])){
			$array = $_SESSION['purch'];
			$qarray = $_SESSION['qty'];
			$num = $_POST['id'];
			$addBack = $_POST['qty'];
			unset($array[$num]);
			unset($qarray[$num]);
			unset($_SESSION['qty']);
			unset($_SESSION['purch']);
			$_SESSION['purch'] = array_values($array);
			$_SESSION['qty'] = array_values($qarray);
			$sql = 'UPDATE music SET qavail = qavail +' .$addBack. ' WHERE id = '.$_POST['id'];
			if ($conn->query($sql) === FALSE) {
				echo "Error!: " . $conn->error;
			} else {
				$conn->query($sql);
			}
		}
	?>
	
	<div id='header'><font color='red'>EDM</font>arket <a href="checkout.php">My Cart</a></div>
	<div id="containter">
		<div id="left" style="float:left; display:inline-block; text-align:center; width:30%; border-style:none; border-right:solid;">
		<?php
			$total = 0;
			$x = 0;
			$qty = $_SESSION['qty'];
			if(isset($_SESSION['purch'])){
				foreach($_SESSION['purch'] as $set){
					$sql = "SELECT * FROM music WHERE id = ".$set;
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
					while($row = mysqli_fetch_array($result)) {
						$id[$x] = $row['id'];
						$band[$x] = $row['artist'];
						$album[$x] = $row['album'];
						$fmat[$x] = $row['format'];
						$notes[$x] = $row['des'];
						$price[$x] = $row['price'];
						$avail[$x] = $row['qavail'];
						$albart[$x] = $row['albart'];
						echo "<div class='2'>";
						echo "<img src='" . $albart[$x] . "' width='100px'><br>";
						echo $band[$x] . ": ";
						echo $album[$x] . "<br>";
						echo "<span><hr>Format: " . $fmat[$x] . "<br>";
						echo $notes[$x] . "</span><hr>";
						echo "$" . $price[$x] . " QTY: ".$qty[$x]."<br>";
						echo "<hr><form method='POST' action='#'>
						<input type='hidden' name='12updt' value='$x'>
						<input type='number' name='updt' min='0' max='".$avail[$x]."'>
						<input type='submit' value='update'></form>";
						echo "<form method='POST' action='#'>
						<input type='hidden' name='id' value='$x'>
						<input type='hidden' name='qty' value='$qty[$x]'>
						<input type='submit' value='DELETE'></form><hr>";
						if(isset($_POST['id'])){
							if($_POST['id'] == $id[$x]){
								echo "<br>".$message;
							}
						}
						echo "</div>";
						$total += $price[$x] * $qty[$x];
						$x++;
					}
				}
			} else {
				echo "<div class='2'>No items in checkout!</div>";
			}
		?>
		</div>
		<div style='padding-top:5%; font-size:300%; text-align:center;'>
			Shipping: <form method='GET' action='?'>
			<select name='ship'>
				<?php if(isset($_GET['ship'])){$_SESSION['ship'] = $_GET['ship'];}else{$_SESSION['ship'] = 0;} ?>
				<option value='0' <?php if(isset($_GET['ship'])){if($_GET['ship'] == '0'){echo "selected='selected'";}} ?>>Standard - $0 [5-10 Days]</option>
				<option value='15' <?php if(isset($_GET['ship'])){if($_GET['ship'] == '15'){echo "selected='selected'";}} ?>>Fast - $15 [2-5 Days]</option>
				<option value='50' <?php if(isset($_GET['ship'])){if($_GET['ship'] == '50'){echo "selected='selected'";}} ?>>Really Fast - $50 [1 day]</option>
			</select>
			<input type='submit' value='Select'></form>
			<br><br>
			<?php if(isset($_GET['ship'])){$total += $_GET['ship'];} ?>
			Total: <?php $_SESSION['total'] = $total; echo "$".$total; ?><br>
			<a href='confirm.php' style='font-size:50%;'>Confirm Order</a>
		<div>
	</div>
</body>

</html>