<!DOCTYPE html>
<html>
    <head>
        <style>
            /* Always set the map height explicitly to define the size of the div
            * element that contains the map. */
            #map {
                height: 90%;
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 100%;
                margin: 0%;
                padding: 0%;
            }
        </style>
    </head>
  <style>
  * {box-sizing: border-box;}

  /*Top bar on the screen that has the search, checkboxes, and slideers. */
  body {
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .topnav {
    overflow: hidden;
    background-color: #e9e9e9;
  }

  .topnav a {
    float: top
    display: block;
    color: black;
    text-align: left;
    margin-right: 40px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav c {
    float: top
    display: block;
    color: black;
    text-align: left;
    margin-right: 10px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav .search-container {
    float: right;
  }

  .topnav input[type=text] {
    padding: 6px;
    margin-top: 6px;
    margin-bottom: 6px;
    font-size: 16px;
    border: none;
  }

  .topnav .search-container button {
    float: right;
    padding: 6px;
    margin-top: 6px;
    margin-right: 16px;
    background: #ddd;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
    .topnav input[type=text] {
      border: 1px solid #ccc;  
    }

  }
  </style>

  <body>

  <div class="topnav">

    	<label class="container">Upload Speed
    	<input type="range" min="0" max="11" value="0" class="slider" id="myRange">
    	<a>Speed: <span id="demo"></span></a>
    	</label>

    	<script>
    		var slider = document.getElementById("myRange");
    		var output = document.getElementById("demo");
    		output.innerHTML = "All";

    		slider.oninput = function() {

          if(slider.value == 0){
            output.innerHTML = "All";
          }

          if(slider.value == 1){
          output.innerHTML = "0 - 200 kbps";
          }
          
          if(slider.value == 2){
          output.innerHTML = "200 - 768  kbps";
          }

          if(slider.value == 3){
          output.innerHTML = "768 kbps - 1.5 mbps";
          }

          if(slider.value == 4){
          output.innerHTML = "1.5 - 3 mbps";
          }

          if(slider.value == 5){
          output.innerHTML = "3 - 6 mbps";
          }
      
          if(slider.value == 6){
          output.innerHTML = "6 - 10 mbps";
          }

          if(slider.value == 7){
          output.innerHTML = "10 - 25 mbps";
          }

          if(slider.value == 8){
          output.innerHTML = "25 - 50 mbps";
          }

          if(slider.value == 9){
          output.innerHTML = "50 - 100 mbps";
          }

          if(slider.value == 10){
          output.innerHTML = "100 mbps - 1 gbps";
          }

          if(slider.value == 11){
          output.innerHTML = "1 gbps -2 gbps";
          }
        }
    	</script>

    	<label class="container2">Download
    	<input type="range" min="0" max="11" value="0" class="slider2" id="myRange2">
    	<c>Speed: <span id="demo2"></span></c>
    	</label>

    	<script>
    		var slider2 = document.getElementById("myRange2");
    		var output2 = document.getElementById("demo2");
    		output2.innerHTML = "All";

    		slider2.oninput = function() {

    			if(slider2.value == 0){
      			output2.innerHTML = "All";
    			}

    			if(slider2.value == 1){
    			output2.innerHTML = "0 - 200 kbps";
    			}
    			
    			if(slider2.value == 2){
    			output2.innerHTML = "200 - 768  kbps";
    			}

    			if(slider2.value == 3){
    			output2.innerHTML = "768 kbps - 1.5 mbps";
    			}

    			if(slider2.value == 4){
    			output2.innerHTML = "1.5 - 3 mbps";
    			}

    			if(slider2.value == 5){
    			output2.innerHTML = "3 - 6 mbps";
    			}
    	
    			if(slider2.value == 6){
    			output2.innerHTML = "6 - 10 mbps";
    			}

    			if(slider2.value == 7){
    			output2.innerHTML = "10 - 25 mbps";
    			}

    			if(slider2.value == 8){
    			output2.innerHTML = "25 - 50 mbps";
    			}

    			if(slider2.value == 9){
    			output2.innerHTML = "50 - 100 mbps";
    			}

    			if(slider2.value == 10){
    			output2.innerHTML = "100 mbps - 1 gbps";
    			}

    			if(slider2.value == 11){
    			output2.innerHTML = "1 gbps -2 gbps";
    			}
    		}
    	</script>

    	<button onclick = "sliders()">Find</button>

    	<script>
    	function sliders(){
        removeMarkers()

        var up=slider.value;
        var down=slider2.value;
        var Func=0;

        if (up==0 & down==0){
         Func=0;
        }
        else if (up!=0 & down ==0){
          Func=2;
        }
        else if (up==0 & down !=0){
          Func=1;
        }
        else if (up!=0 & down !=0){
          Func=5;
        }
        param="Up="+up+"&Down="+down+"&Func="+Func;
        SendRequest(param);

    	}
    	</script>

      <div class="search-container">

    	

      	<input type="text" id="mySearch" placeholder="Zip Code...">
      	<button onclick = "searching()">Search</button>
      
    	
      <script>
    	function searching() {
        	var search = document.getElementById("mySearch").value;

           var param="gzip="+search+"&Func=3";

            SendRequest(param);//sends data request with variables

    	}
    	</script>
      </div>

  </div>

  </body>

  <body>
  <div id="map"></div>
    <script>
      //create map
      var map;
      var gmarkers = [];

      function initMap() {
          map = new google.maps.Map(document.getElementById('map'), {
              zoom: 7, center: new google.maps.LatLng(40.900,-77.194), //center of PA
          });
        var opt = {minZoom:7}; //sets max zoom out to 7
        map.setOptions(opt);

        // bounds of the desired area
        var allowedBounds = new google.maps.LatLngBounds(
         		new google.maps.LatLng(39.59,-80.68), 
         		new google.maps.LatLng(42.33,-74.62)
        );
        var lastValidCenter = map.getCenter();
        google.maps.event.addListener(map, 'center_changed', function() {
        		if (allowedBounds.contains(map.getCenter())) {
            		// still within valid bounds, so save the last valid position
            		lastValidCenter = map.getCenter();
            		return; 
       		 }
        		// not valid anymore => return to last valid position
        		map.panTo(lastValidCenter);
      	});
      }

                                                                  /*
                                                                    var MimU="0";
                                                                    var MamU="4";
                                                                    var MimD="5";
                                                                    var MamD="11";
                                                                    var gzip="17101";
                                                                    var Func="0";
                                                                    //var param="MimU="+MimU+"&MamU="+MamU+"&MimD="+MimD+"&MamD="+MamD+"&gzip="+gzip+"&Func="+Func;
                                                                   //console.log(param);
                                                                    //SendRequest(param);//sends data request with variables
                                                                    */
    </script>


    <script>//general functions
      function GetInfo(param){
        var oReq = new XMLHttpRequest(); //New request object;
        oReq.open("post", "get-data.php", false)
        oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");   

        oReq.onreadystatechange = function() { //Call a function when the state changes.
          if(oReq.readyState == 4 && oReq.status == 200) { // complete and no errors
            var myArr = JSON.parse(this.responseText);
            alert("Provider: "+myArr.provname+"\n"+
              "Company: "+myArr.hoconame+"\n"+
              " download: "+spd(myArr.downloadspeed)+"\n"+
              " upload: "+spd(myArr.uploadspeed)+"\n"+
              "Category: "+Cat(myArr.end_user_cat)+"\n");
          }
        }
        oReq.send(param);
      }

        //sends request
      function SendRequest(param){

        var oReq = new XMLHttpRequest(); //New request object;
        oReq.open("post", "get-data.php", true)
        oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
        oReq.onreadystatechange = function() { //Call a function when the state changes.
          if(oReq.readyState == 4 && oReq.status == 200) { // complete and no errors
            //console.log(this.responseText);
            var myArr = JSON.parse(this.responseText);
            
            //console.log(myArr[0]);
            if (myArr[0]==null){
              alert("nothing found");
            }
            else{
              marker(myArr);
            }
          }
        }
        oReq.send(param);
      }  
      // places markers
      function marker(jsondata) {
        for(var i = 0; i < jsondata.length; i++) {
          var coords =jsondata[i]
          var markdata= coords.objectid
          var latLng= new google.maps.LatLng(coords.latitude, coords.longitude)
          var marker = new google.maps.Marker({position:latLng, map: map, customInfo:markdata, })
          var t = new google.maps.event.addListener(marker, 'click', function(){GetInfo("OBJid="+this.customInfo+"&Func=4")})
          gmarkers.push(marker);
        }
      }

      function removeMarkers(){
        for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
    }
}

      function spd(id){
        if(id==1){
            return "0 - 200 kbps";
        }
        else if (id==2){
            return "200 - 768  kbps";
        }
        else if (id==3){
            return "768 kbps - 1.5 mbps";
        }
            else if (id==4){
            return "1.5 - 3 mbps";
        }
            else if (id==5){
            return "3 - 6 mbps";
        }
            else if (id==6){
            return "6 - 10 mbps";
        }
            else if (id==7){
            return "10 - 25 mbps";
        }
            else if (id==8){
            return "25 - 50 mbps";
        }
            else if (id==9){
            return "50 - 100 mbps";
        }
            else if (id==10){
            return "100 mbps - 1 gbps";
        }
            else if (id==11){
            return "1 gbps -2 gbps";
        }
        else{
            return "error";
        }
      }

      function Cat(id){
        if (id==1){
            return "Residential";
        }
        else if (id==2){
            return "Goverment";
        }
        else if (id==3){
            return "small buisness";
        }
        else if (id==4){
            return "medium or large enterprise";
        }
        else if (id==5){
            return "other";
        }
        else{
            return "error";
        }
      }
                                              //unused functions
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

                                              function heat(jsondata) {
                                                  var heatmapData = [];
                                                  for(var i = 0; i < jsondata.length; i++) {
                                                      var coords =jsondata[i]
                                                      var markdata= coords.objectid
                                                      var latLng = new google.maps.LatLng(coords.latitude, coords.longitude);
                                                      var magnitude = coords.downloadspeed;
                                                      var weightedLoc = {
                                                          location: latLng,
                                                          weight: Math.pow(2,magnitude)
                                                      };
                                                      heatmapData.push(weightedLoc);
                                                  }
                                                  var heatmap = new google.maps.visualization.HeatmapLayer({
                                                    data: heatmapData,
                                                    dissipating: false,
                                                    map: map
                                                  });
                                              }
    //src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3IJFse1sdzlssxc9uGB52cWWKod70ZI&libraries=visualization&callback=initMap">
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3IJFse1sdzlssxc9uGB52cWWKod70ZI&callback=initMap">
    </script>

  </body>
</html>