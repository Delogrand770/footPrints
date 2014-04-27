<?php
  // retrieve session information
  session_start();
  if (!isset($_SESSION['twitterResult']) && !isset($_SESSION['instagramResult'])){
    header("location:../index.php");
    exit;
  }
?>

<html>
  <head>
    <title>Results</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <style type="text/css">
      html {
        background-image: url("https://usafa.teelsoft.net/footprints/images/pic3.jpg");
        background-position: center bottom;
        background-attachment: fixed;
        background-size: cover;
        height: 100%;
        font-size: 100%;
        font-family: "Megrim", sans-serif;
      }

      body {
        margin: 0;
      }

      .glass {
        position: relative;
        padding: 10px 10px;
        border-bottom: 1px solid;
        border-bottom-color: rgba(255, 255, 255, 0.2);
        background-color: rgba(128, 128, 128, 0.2);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        height: 50px;
      }

      .glass2 {
        position: relative;
        padding: 10px 10px;
        border: 1px solid;
        border-color: rgba(255, 255, 255, 0.1);
        background-color: rgba(0, 0, 0, 0.5);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      }

      .glass::before {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20xmlns%3Axlink%3D%22http%3A//www.w3.org/1999/xlink%22%20version%3D%221.1%22%20width%3D%221920%22%20height%3D%221120%22%3E%3Cdefs%3E%3Cfilter%20id%3D%22blur%22%3E%3CfeGaussianBlur%20stdDeviation%3D%225%22/%3E%3C/filter%3E%3C/defs%3E%3Cimage%20xlink%3Ahref%3D%22https%3A//usafa.teelsoft.net/images/pic3.jpg%22%20width%3D%221920%22%20height%3D%221120%22%20filter%3D%22url%28%23blur%29%22/%3E%3C/svg%3E"), url("https://usafa.teelsoft.net/footprints/images/pic3.jpg");
        background-position: center bottom;
        background-attachment: fixed;
        background-size: cover;
        content: "";
        filter: url("data:image/svg+xml,%3C%3Fxml%20version%3D%221.0%22%20encoding%3D%22UTF-8%22%3F%3E%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%3E%3Cdefs%3E%3Cfilter%20id%3D%22blur%22%3E%3CfeGaussianBlur%20stdDeviation%3D%225%22%2F%3E%3C%2Ffilter%3E%3C%2Fdefs%3E%3C%2Fsvg%3E#blur");
        -webkit-filter: blur(5px);
        filter: blur(5px);
      }

      .glass h1 {
        position: relative;
        margin: 0;
        color: #fff;
        color: rgba(255, 255, 255, 0.3);
        font-size: 50px;
        font-weight: normal;
        font-family: "Megrim", sans-serif;
        line-height: 1;
        text-align: center;
      }

      .glass2 h3 {
        position: relative;
        margin: 0;
        color: #fff;
        color: rgba(255, 255, 255, 0.9);
        font-size: 30px;
        font-weight: normal;
        font-family: "Megrim", sans-serif;
        line-height: 1;
        text-align: center;
      }

      .input{
        height:40;
        width:600;
        padding: 10px 10px;
        border: 1px solid;
        border-bottom: 1px solid;
        border-bottom-color: #ccc;
        border-bottom-color: rgba(255, 255, 255, 0.2);
        background-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        margin: 0;
        color: #fff;
        color: rgba(255, 255, 255, 0.7);
        font-size: 18px;
        font-weight: normal;
        font-family: "Megrim", sans-serif;
        line-height: 1;
      }
      .btn{
        height:35;
        width:100;
        padding: 10px 10px;
        border: 1px solid;
        border-color: rgba(255, 255, 255, 0.2);
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        margin: 0;
        color: #fff;
        color: rgba(255, 255, 255, 0.9);
        font-size: 17px;
        font-weight: normal;
        font-family: "Megrim", sans-serif;
        line-height: 1;
      }
    </style>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="../js/gEarth.js"></script>
<script>
var Page = {  
  setup:function(){
    var error = Utility.getURLParameter('error');
    if (error){
      document.getElementById('errors').innerHTML = error;
      document.getElementById('map3d').style.visibility = "hidden";
      document.getElementById('contentDiv').style.display = "block";
    }
    Page.position();
  },
  googleEarthReady:function(){
    Twitter.parse(<?php echo json_encode($_SESSION['twitter']); ?>);
    Instagram.parse(<?php echo json_encode($_SESSION['instagram']); ?>);
    gEarth.parseKML(gEarth.generateKML(gEarth.nodes));
  },
  showMap:function(){
      document.getElementById('contentDiv').style.display = "none";
      document.getElementById('map3d').style.visibility = "visible";
  },
  addError:function(data){
    document.getElementById('errors').innerHTML += data;
    document.getElementById('map3d').style.visibility = "hidden";
    document.getElementById('contentDiv').style.display = "block";  
  },
  position:function(){
    Utility.centerElement('contentDiv', 'b', 0, 0);
  }
};

var Twitter = {
  parse:function(doit){
    if (doit){
      var myvar = <?php echo json_encode($_SESSION['twitterResult']); ?>;
      //Page.addError(myvar)
      var myvar = eval("(" + myvar + ")");
      var coordCount = 0;
      var totalCount = 0;

      for(var i in myvar){
        totalCount++;
        if (myvar[i].coordinates != null){
          coordCount++;
          var date_a = myvar[i].created_at.split(':');
          var date_b = myvar[i].created_at.split('+');
          var date_actual = date_a[0].substring(0, date_a[0].length - 2) + " " + date_b[1].substring(5, date_b[1].length);
          var time_actual = date_b[0].substring(10, date_b[0].length);
          var locationName = (myvar[i].place && myvar[i].place.full_name) ? myvar[i].place.full_name : "Unavailable";
          gEarth.nodes[gEarth.nodes.length] = new gEarth.kmlNode('twitter', date_actual, myvar[i].text, myvar[i].coordinates.coordinates[0], myvar[i].coordinates.coordinates[1], locationName, time_actual);
        }
      }

      var error = (totalCount == 0) ? "Twitter profile is protected or has never tweeted<br>" : (coordCount == 0) ? "Twitter profile has geolocation disabled or hasn't used it in the last 200 tweets<br>" : "";
      if (error.length > 0){Page.addError(error)}
    }
  }
}

var Instagram = {
  parse:function(doit){
    if (doit){
      var myvar = <?php echo json_encode($_SESSION['instagramResult']); ?>;
      //Page.addError(myvar)
      var myvar = eval("(" + myvar + ")");
      var coordCount = 0;
      var totalCount = 0;

      var datas = myvar['data'].length;
      for (var i = 0; i < datas; i++){
        totalCount++;
        var node = myvar['data'][i];
        var nodeLocation = node['location'];
        var nodeImage = node['images']['low_resolution'];
        var nodeData = node['caption'];
        var locationName = (nodeLocation && nodeLocation.name) ? nodeLocation.name : "Unavailable";

        if (nodeLocation && nodeImage && nodeData){
          coordCount++;
          var date_a = new Date(parseInt(nodeData.created_time) * 1000);
          var date_actual = (date_a.getMonth()+1)+"/"+date_a.getDate()+"/"+date_a.getFullYear();
          gEarth.nodes[gEarth.nodes.length] = new gEarth.kmlNode('instagram', date_actual, nodeData.text + '<br><img src="' + nodeImage.url + '">', nodeLocation.longitude, nodeLocation.latitude, locationName, "Unavailable");
        }
      }

      var error = (totalCount == 0) ? "Instagram profile is protected or has never posted<br>" : (coordCount == 0) ? "Instagram profile has geolocation disabled or hasn't used it<br>" : "";
      if (error.length > 0){Page.addError(error)}
   }
  }
}
</script>

</head>
<body onload="Page.setup();" onresize="Page.position()">

<input type="button" value="back" style="position:absolute;top:10;left:10;" class="btn">

<div class="header glass" onclick="parent.location='../index.php'" style="cursor:hand;"><center><h1 style="color:rgba(255, 255, 255, 0.3);">footPrints</h1></center></div>

<div id="contentDiv" style="position:absolute;width:50%;display:none;" class="glass2">
  <center>
    <h3>oops we have some errors</h3>
    <hr>
      <p style="color:rgba(255, 255, 255, 0.5);">
        <span id="errors"></span>
      </p>
    <p style="color:rgba(255, 255, 255, 0.5);"><br>
      <input type="button" value="back" class="btn" onclick="location.href='../index.php'"> 
      <input type="button" value="map" class="btn" onclick="Page.showMap()">
    </p>
  </center>
</div>

</body>
</html>
