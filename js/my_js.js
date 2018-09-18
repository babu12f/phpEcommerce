
// Validating Empty Field
function init(){
browser({
	contentsDisplay:document.getElementById("dvContents"),
	currentPath:"images"
	});
}

//Function To Display Popup
function div_show() {
	document.getElementById('abc').style.display = "block";
	document.getElementById('uploadForm').style.display = "none";
	document.getElementById('dvContents').style.display="block";
	document.getElementById('recentFile').style.display="none";
	//init();
}
//Function To Check Target Element
function check(e) {
	var target = (e && e.target) || (event && event.srcElement);
	var obj = document.getElementById('abc');
	var obj2 = document.getElementById('popup');
	checkParent(target) ? obj.style.display = 'none' : null;
	target == obj2 ? obj.style.display = 'block' : null;
}
//Function To Check Parent Node And Return Result Accordingly
function checkParent(t) {
	while (t.parentNode) {
		if (t == document.getElementById('abc')) {
			return false
		} else if (t == document.getElementById('close')) {
			return true
		}
	/*else if (t == document.getElementById('sub')) {
	return true
	}*/
	t = t.parentNode
	}
	return true
}

function show_upload(){
	document.getElementById('uploadForm').style.display = "block";
	document.getElementById('dvContents').style.display="none";
	document.getElementById('recentFile').style.display="none";
}
function recent_file(){
    temp_Id1="";
    turn1=true;
	showRecentFile({
		contentsDisplay:document.getElementById("recentFile"),
		currentPath:"images"
	});
	document.getElementById('uploadForm').style.display = "none";
	document.getElementById('dvContents').style.display="none";
	document.getElementById('recentFile').style.display="block";
	
	
}


function insImage(fpath){
	var path=fpath;
	iImage(path);	
}

function ar(){
	w();
}