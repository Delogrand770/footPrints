var ge;
var gEarth = {
	nodes: new Array(),
	apiLoad: google.load("earth", "1", {"other_params":"sensor=false"}),
	init:function(){
		document.body.innerHTML += '<div id="map3d" style="position:absolute;height:90%;width:99%;"></div>';
		google.earth.createInstance('map3d', gEarth.initCB, gEarth.failureCB);
	},
	initCB:function(instance){
		ge = instance;
		ge.getWindow().setVisibility(true);

		// add a navigation control
		ge.getNavigationControl().setVisibility(ge.VISIBILITY_AUTO);

		// add some layers
		ge.getLayerRoot().enableLayerById(ge.LAYER_BORDERS, true);
		ge.getLayerRoot().enableLayerById(ge.LAYER_ROADS, true);
		try{
			Page.googleEarthReady();
		}catch(e){
			alert('You need to specify a Page.googleEarthReady() \n\n' + e);
		}
	},
	failureCB:function(instance){},
	parseKML:function(data){
		var kmlObject = ge.parseKml(data);
		ge.getFeatures().appendChild(kmlObject);
	},
	kmlNode:function(service, name, post, latitude, longitude, date, time){
		this.service = service;
		this.name = name;
		this.post = post;
		this.latitude = latitude;
		this.longitude = longitude;
		this.date = date;
		this.time = time;
	},
	generateKML:function(nodeList){
		var data  = '';
		data += '<?xml version="1.0" encoding="UTF-8"?>';
		data += '<kml xmlns="http://www.opengis.net/kml/2.2">';
		data += '<Document>';

		data += '<Style id="twitter">';
		data += '<IconStyle>';
		data += '<Icon><href>https://usafa.teelsoft.net/footprints/images/twitter.png</href></Icon>';
		data += '<scale>2.0</scale>';
		data += '</IconStyle>';
		data += '</Style>';

		data += '<Style id="instagram">';
		data += '<IconStyle>';
		data += '<Icon><href>https://usafa.teelsoft.net/footprints/images/instagram.png</href></Icon>';
		data += '<scale>2.0</scale>';
		data += '</IconStyle>';
		data += '</Style>';

		for (var i = 0; i < nodeList.length; i++){
			data += '<Placemark>';
			data += '<styleUrl>#' + nodeList[i].service + '</styleUrl>';
			data += '<name>' + nodeList[i].name + '</name>';
			data += '<description>';
			data += '<![CDATA[';
			data += '<b>Location Name: </b>' + nodeList[i].date + '<br>';
			data += '<b>Time: </b>' + nodeList[i].time + '<br>';
			data += '<b>Post: </b><center>' + nodeList[i].post + '</center><br>';
			data += ']]>';
			data += '</description>';
			data += '<Point>';
			data += '<coordinates>' + nodeList[i].latitude + ', ' + nodeList[i].longitude + ', 0</coordinates>';
			data += '</Point>';
			data += '</Placemark>';
		}

		data += '</Document>';
		data += '</kml>';
		return data;
	}
}
google.setOnLoadCallback(gEarth.init);