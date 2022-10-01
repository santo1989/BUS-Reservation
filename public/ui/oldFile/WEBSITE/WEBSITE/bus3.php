 <?php
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


$sql = "SELECT id, Header, Footer, Bus3 FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " " . $row["Header"]. " " . $row["Bus3"]." " . $row["Footer"]. "";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
