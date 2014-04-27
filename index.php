<?php
	session_start();
  session_destroy();
?>

<html>
<head>
<title>footPrints</title>

<style>	
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
  padding: 10px 0;
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
  border-bottom-color: rgba(255, 255, 255, 0.2);
  border-right-color: rgba(255, 255, 255, 0.2);
  background-color: rgba(0, 0, 0, 0.7);
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
  border-color: rgba(255, 255, 255, 0.2);
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
<script src="js/utility.js"></script>
<script>
var Page = {
	setup:function(){
		Utility.centerElement('searchDiv', 'b', 0, 0);
		//document.getElementById('twitterQuery').value = "";
		//document.getElementById('instagramQuery').value = "";
		document.getElementById('twitterQuery').focus();
	},
	search:function(){
		if (event.keyCode==13){
			document.searchForm.submit();
		}
	}
}

</script>
</head>
<body onload="Page.setup()" onresize="Page.setup()">

<div class="header glass">
  <h1>footPrints</h1>
</div>

<div id="searchDiv" style="position:absolute;" class="glass2">
	<center>
  	<form name="searchForm" method="post" action="t/combinedQuery.php">
      <h3>twitter</h3>
  		<input type="textarea" id="twitterQuery" name="twitterQuery" class="input" onkeyup="Page.search()" value="geo_cacher">
  		<br><br>
      <h3>instagram</h3>
  		<input type="textarea" id="instagramQuery" name="instagramQuery" class="input" onkeyup="Page.search()" value="gogeocaching">
      <br><br>
      <input type="submit" value="search" class="btn" /><br>
      <font color="white">enter valid a username for one or both sites</font>
  	</form>
    <a href="about.php" style="color:rgba(255, 255, 255, 0.3);">about footPrints</a> &nbsp;&nbsp;&nbsp; <a href="mailto:c14gavin.delphia@usafa.edu?subject=footprints" style="color:rgba(255, 255, 255, 0.3);">feedback</a>
	</center> 
</div>

</body>
</html>