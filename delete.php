<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="robots" content="noindex">
<title>DELETE</title>

</head>

<body>
<?php

$servername = 'localhost';
$username = 'root';
$password = 'Zaqwedc1';

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db('edmarket');

unset($_SESSION);
$sql = "DROP TABLE music";	
	if ($conn->query($sql) === TRUE) {
		echo "Table deleted successfully";
	} else {
		echo "Error: " .$conn->error;
	}
?>
</body>

</html>