<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css">
<meta charset="UTF-8">
<meta name="robots" content="noindex">
<title>EDMarket - Confirmation</title>

</head>

<body>

<div style='text-align:center;'>
	<h2>Your Order Has Been Confirmed!</h2><br>
	<p>Your total is $<?php echo $_SESSION['total']; ?><br>
	Your order will arrive in <?php if($_SESSION['ship'] == 0){echo '5-10 Days!';} else if ($_SESSION['ship'] == 15){echo '3-5 Days!';} else if($_SESSION['ship'] == 50){echo '1 Day';} else{echo 'never.';} ?>
</div>

</body>

</html>