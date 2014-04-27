var Utility = {
	centerElement:function(eleId, mode, xOffset, yOffset){
		xOffset = xOffset || 0;
		yOffset = yOffset || 0;
		if (mode == 'v' || mode == 'b'){
			Utility.el(eleId).style.top = Math.round(yOffset + (parseInt(document.body.offsetHeight || screen.height) / 2) - (Utility.el(eleId).offsetHeight / 2)) + yOffset;
		}
		if (mode == 'h' || mode == 'b'){
			Utility.el(eleId).style.left = Math.round(xOffset + (parseInt(document.body.offsetWidth || screen.width) / 2) - (Utility.el(eleId).offsetWidth / 2)) + xOffset;
		}
	},
	DFR:function(eleId, distance){
		Utility.el(eleId).style.left = Math.round(parseInt(document.body.offsetWidth) - (Utility.el(eleId).offsetWidth + distance));
	},
	DFB:function(eleId, distance){
		Utility.el(eleId).style.top = Math.round(parseInt(document.body.offsetHeight) - (Utility.el(eleId).offsetHeight + distance));
	},
	el:function(eleId){
		return document.getElementById(eleId);
	},
	changeClass:function(eleId, className){
		Utility.el(eleId).className = className;
	},
	toString:function(obj){
		var data = "";
		for (var prop in obj){
			data += prop + ": " + obj[prop] + "\n";
		}
		return data;
	},
	intoBody:function(data){
		var container = document.createElement("SPAN");
		container.innerHTML = data;
		document.body.appendChild(container);
	},
	getURLParameter:function(name){
  		return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
	}
}

