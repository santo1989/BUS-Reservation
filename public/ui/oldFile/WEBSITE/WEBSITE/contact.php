<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(!empty($_POST["username"])) {
		$username = $_POST["username"];
		
		if($username == '2752') {
			session_start();
			$_SESSION["authenticated"] = 'true';
			header('Location: contact27.php');
		}
		else {
			header('Location: contact.php');
		}
		
	} else {
		header('Location: contact.php');
	}
} else {
}

$servername = "localhost";
$username = "nmathews_bacon54";
$password = "Mx5702762";
$dbname = "nmathews_websitedata";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, Header, Footer, Validate1 FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " " . $row["Header"]. " " . $row["Validate1"]." " . $row["Footer"]. "";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
