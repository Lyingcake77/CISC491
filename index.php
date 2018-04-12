

<!DOCTYPE html>
<html>
    <head>
        <style>
            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
                height: 80%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0%;
                padding: 0%;
            }
        </style>
    </head>

    
<body>
<div id="map"></div>



<script>
    //create map
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7, center: new google.maps.LatLng(40.900,-77.194) //centers map on PA
        });
        var param="Mim=5&Mam=7";
        //SendRequest(param);//sends data request with variables
        var jsondata = callData(); //calls data, then places markers


    }
</script>




 <script>
    //general functions

    //sends request
    function SendRequest(param){

        var oReq = new XMLHttpRequest(); //New request object;
         oReq.open("post", "get-data.php", true)

            oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            console.log(param)
            var myArr = JSON.parse(this.responseText);
            marker(myArr);


        oReq.onreadystatechange = function() { //Call a function when the state changes.
            if(oReq.readyState == 4 && oReq.status == 200) { // complete and no errors
                console.log(oReq.responseText); // some processing here, or whatever you want to do with the response
                }
         }

        oReq.send(param);  
    }


    //calls data
    function callData(){
        var oReq = new XMLHttpRequest(); //New request object;
         oReq.open("get", "get-data.php", true)


        oReq.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                var myArr = JSON.parse(this.responseText);
                marker(myArr);
            };
        };
        oReq.send();  
    }
        
 
    // places markers
    function marker(jsondata) {
        for(var i = 0; i < jsondata.length; i++) {
            var coords =jsondata[i]
            var latLng= new google.maps.LatLng(coords.latitude, coords.longitude)
            var marker = new google.maps.Marker({position:latLng, map: map})
        }
    }
</script>



<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3IJFse1sdzlssxc9uGB52cWWKod70ZI&callback=initMap">
</script>

</body>
</html>