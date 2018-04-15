<?php

//range of speeds
if (isset($_POST['MimU'])) //checks if exists
{ 
	 $MimU=(int)$_POST["MimU"];
} 
if (isset($_POST['MamU'])) 
{ 
	$MamU= (int)$_POST["MamU"];
} 
if (isset($_POST['MimD'])) //checks if exists
{ 
	 $MimD=(int)$_POST["MimD"];
} 
if (isset($_POST['MamD'])) 
{ 
	$MamD= (int)$_POST["MamD"];
} 


//zip search
if (isset($_POST['gzip'])) 
{ 
	$gzip=$_POST["gzip"];
} 

//unquie id
if (isset($_POST['OBJid'])) 
{ 
	$OBJid=$_POST["OBJid"];
} 

//determines which function runs
if (isset($_POST['Func'])) { 
	$Func=$_POST["Func"];
	if ($Func==0){
		getAll();
	}
	elseif ($Func==1) {
		getDownload($MimD,$MamD);
	}
	elseif ($Func==2) {
		getUpload($MimU,$MamU);
	}
	elseif ($Func==3) {
		getZip($gzip);
	}
	elseif ($Func==4) {
		getSpecific($OBJid);
	}
	elseif ($Func==5){
		getUpDown($MimU,$MamU,$MimD,$MamD);
	}
} 
else{
	getall();
}

//get all data points
function getAll(){
	// Create connection
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

	//create json data
	$result = $conn->query($sql);
	$myArray = array();
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	 $myArray[] = $row;
	    }
	} else {
	    echo "0 results";//if none exists
	}
	 echo json_encode($myArray);//send json data

	$conn->close();
}

//get specific zip
function getZip($zip){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fcc_data";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//get specific location
	$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
	FROM fcc_database
	RIGHT JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid
	where block_reffernce.zip5 = $zip";


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

//get all dataponts within range of upload speeds
function getUpload($Min,$Max){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fcc_data";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//get all upload
	$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
	FROM fcc_database
	RIGHT JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid
	where fcc_database.uploadspeed >= $Min and fcc_database.uploadspeed <= $Max";


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

//get all dataponts within range of download speeds
function getDownload($Min,$Max){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fcc_data";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//get range of locations
	$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
	FROM fcc_database
	RIGHT JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid
	where fcc_database.downloadspeed >= $Min and fcc_database.downloadspeed <= $Max";

	//creat json string
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

//get info on specific datapoint
function getSpecific($Id){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fcc_data";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//get specific id
	$sql = "SELECT * 
	FROM fcc_database
	where fcc_database.objectid= '$Id'";

	//query
	$result = $conn->query($sql);
	$myArray = array();

	//make json string
	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	echo json_encode($row);
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
}

function getUpDown($MimU,$MamU,$MimD,$MamD){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "fcc_data";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);} 


	//get range of locations
	$sql = "SELECT block_reffernce.latitude, block_reffernce.longitude, fcc_database.objectid 
	FROM fcc_database
	RIGHT JOIN block_reffernce ON fcc_database.fullfipsid = block_reffernce.fullfipsid
	where fcc_database.downloadspeed >= $MimD and fcc_database.downloadspeed <= $MamD and fcc_database.uploadspeed >= $MimU and fcc_database.uploadspeed <= $MamU";

	//creat json string
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
