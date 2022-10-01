<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(!empty($_POST["username"])) {
		$username = $_POST["username"];
		
		if($username == '4726') {
			session_start();
			$_SESSION["authenticated"] = 'true';
			header('Location: searchbus.php');
		}
		else {
			header('Location: quote.php');
		}
		
	} else {
		header('Location: quote.php');
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

$sql = "SELECT id, Header, Footer, Validate2 FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " " . $row["Header"]. " " . $row["Validate2"]." " . $row["Footer"]. "";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
