<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcc_data";

/*
//which type of function to call
$fun=$_POST["Func"];

//range of speeds
$Mim=$_POST["Mim"];
$Mam= $_POST["Mam"];

//zip search
$gZip1=$_POST["gZip1"];
$gZip2=$_POST["gZip2"];

//uppload or download
$type=$_POST["type"];

//getLatLong($Mim,$Mam);

//will need: min speed max speed
*/

getLatLong(0,1);
//need speed_refernce, fcc_database, block_reffernce... mainly

//Find all data where given Zip
	//compare zip with fipsID, get all fips data(up,down,company) then get lat & long

//find all data where range is true, type is given,
	// get fips(id), get coords

$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
FROM fcc_database
RIGHT JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid
where fcc_database.typicdown >8";


function getLatLong($Mim,$Mam){
	// Create connection
	//echo json_encode($Mim);
	//echo json_encode($Mam);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcc_data";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//query
	$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
FROM fcc_database
inner JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid";
//where fcc_database.typicdown >8

	$result = $conn->query($sql);
	$myArray = array();
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	 $myArray[] = $row;
	    }
	} else {
	    echo "0 results";
	}
	 echo json_encode($myArray);

	$conn->close();

	//will need fullfipsid
}

function getZip1(){
	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcc_data";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//query
	$sql = "SELECT latitude,longitude FROM block_reffernce";
	$result = $conn->query($sql);
	$myArray = array();
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	 $myArray[] = $row;
	    }
	} else {
	    echo "0 results";
	}
	 echo json_encode($myArray);
	$conn->close();
}

function getZip2(){
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//query
	$sql = "SELECT latitude,longitude FROM block_reffernce";
	$result = $conn->query($sql);
	$myArray = array();
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	 $myArray[] = $row;
	    }
	} else {
	    echo "0 results";
	}
	 echo json_encode($myArray);
	$conn->close();
}



?>
