

<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: new google.maps.LatLng(40.900,-77.194)
        });

        //calls data, then places markers
        var jsondata = callData();


       // document.getElementsByTagName('head')[0].appendChild(script);   
      }



     
    
/*
      window.eqfeed_callback = function(results) {
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1],coords[0]);
          var marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
        }
      }

*/


    </script>


     <script>
        //calls data
    function callData(){
        var oReq = new XMLHttpRequest(); //New request object;
        oReq.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                marker(myArr);
            };
        }

        oReq.open("get", "get-data.php", true);
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






    function doNothing() {

    }


    function reqListener () {
      console.log( this.responseText);
    }


    </script>





    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3IJFse1sdzlssxc9uGB52cWWKod70ZI&callback=initMap">
    </script>
  </body>
</html>