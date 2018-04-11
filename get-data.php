<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcc_data";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT latitude,longitude FROM block_reffernce";
$result = $conn->query($sql);
$myArray = array();
if ($result->num_rows > 0) {

   // echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	 $myArray[] = $row;

        //echo "<tr><td>".$row["latitude"]."</td><td>".$row["longitude"]."</td></tr>";
    }
    //echo "</table>";
} else {
    echo "0 results";
}

 echo json_encode($myArray);

$conn->close();

?>
