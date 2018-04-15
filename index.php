

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
        var MimU="0";
        var MamU="4";

        var MimD="5";
        var MamD="11";

        var gzip="17101";
        var Func="0";
        


        var param="MimU="+MimU+"&MamU="+MamU+"&MimD="+MimD+"&MamD="+MamD+"&gzip="+gzip+"&Func="+Func;
       console.log(param);
        //SendRequest(param);//sends data request with variables
        var jsondata = SendRequest(param); //calls data, then places markers
       // var jsondara=callData();

    }

</script>




 <script>
    //general functions


function GetInfo(param){

        var oReq = new XMLHttpRequest(); //New request object;
         oReq.open("post", "get-data.php", false)

            oReq.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            

        oReq.onreadystatechange = function() { //Call a function when the state changes.
            if(oReq.readyState == 4 && oReq.status == 200) { // complete and no errors
                //console.log(this.responseText);
                //console.log(this.responseText);
                 var myArr = JSON.parse(this.responseText);
                 alert("Provider: "+myArr.provname+"\n"+
                    "Company: "+myArr.hoconame+"\n"+
                    " download: "+spd(myArr.downloadspeed)+"\n"+
                    " upload: "+spd(myArr.uploadspeed)+"\n"+
                    "Category: "+Cat(myArr.end_user_cat)+"\n");
                 //return myArr;
                 // marker(myArr);

                 // some processing here, or whatever you want to do with the response
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
                console.log(this.responseText);
                //console.log(this.responseText);
                 var myArr = JSON.parse(this.responseText);
                  marker(myArr);

                 // some processing here, or whatever you want to do with the response
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
        //console.log(jsondata);
        for(var i = 0; i < jsondata.length; i++) {
            var coords =jsondata[i]

            var markdata= coords.objectid
            



            var latLng= new google.maps.LatLng(coords.latitude, coords.longitude)
            var marker = new google.maps.Marker({position:latLng, map: map, customInfo:markdata, })
            //var t = new google.maps.event.addListener(marker, 'click', function() {alert(this.customInfo);});
            var t = new google.maps.event.addListener(marker, 'click', function(){GetInfo("OBJid="+this.customInfo+"&Func=4")})

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
</script>



<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3IJFse1sdzlssxc9uGB52cWWKod70ZI&callback=initMap">
</script>

</body>
</html>