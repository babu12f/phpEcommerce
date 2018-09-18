var allImageStore= new Array();

var PictureBox = document.getElementById("dvContents");

var temp_Id = "";
var turn = true;

function browser(params){
	if(params==null)params={};
	if(params.contentsDisplay==null)params.contentsDisplay=document.body;
	if(params.currentPath==null)params.currentPath="";
	if(params.filter==null)params.filter="";
	if(params.loadingMessage==null)params.loadingMessage="Loading...";
	if(params.data==null)params.data="";

	var search=function(){
		if(params.pathDisplay!=null)params.pathDisplay.innerHTML=params.loadingMessage;
		
		var f=typeof(params.filter)=="object"?params.filter.value:params.filter;
		var a=new Ajax();
		with (a){
			Method="POST";
			URL="search_dir.php";
			Data="path="+params.currentPath+"&filter="+f+"&data="+params.data;
			ResponseFormat="json";
			ResponseHandler=showFiles;
			Send();
		}
	}
	
	if(params.refreshButton!=null)params.refreshButton.onclick=search;

	var showFiles=function(res){
		allImageStore = res;
		if(params.pathDisplay!=null){
			var p=res.currentPath;
			p=p.replace(/^(\.\.\/|\.\/|\.)*/g,"");
			
			if(params.pathDisplay!=null){
				params.pathDisplay.title=p;
				if(params.pathMaxDisplay!=null){
					if(p.length>params.pathMaxDisplay)p="..."+p.substr(p.length-params.pathMaxDisplay,params.pathMaxDisplay);
				}
				params.pathDisplay.innerHTML="[Rt:\] "+p;
			}
		}
		
		params.contentsDisplay.innerHTML="";
		var oddeven="odd";
		
		for (i=1;i<=10;i++){
			var f=res.contents[i];
			var el=document.createElement("img");
			with(el){
				setAttribute("title",f.fName);
				setAttribute("fPath",f.fPath);
				setAttribute("fType",f.fType);
				setAttribute("Id",i);
				className="itemft";
				id=i;
				width=200;
				height=200;
				src=f.fPath;
				//innerHTML= document.write("<img src="+f.fPath+">");
			}
			params.contentsDisplay.appendChild(el);
			oddeven=(oddeven=="odd")?"even":"odd";
			el.onclick=selectItem;
		}
	}
	
	
	//var temp_Id="";
	//var turn=true;
	
	var selectItem=function(){
		var ftype=this.getAttribute("fType");
		var fpath=this.getAttribute("fPath");
		var ftitle=this.getAttribute("title");
		var Id=this.getAttribute("Id");
		//var id = document.get.ElementById(Id).value();
		//document.getElementById(Id).style.border='2px solid #3399CC';
		//document.getElementById('sub').onclick=function(){
			//iImage(fpath)
			//};
		//setImagepath(fpath);
			//alert(fpath);
			
			if(temp_Id==""){
				document.getElementById(Id).style.border='4px solid #3399CC';
				temp_Id=Id;
				tpath=fpath;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';

				}
			}
			else if(temp_Id==Id && turn==true){
				document.getElementById(Id).style.border='none';
				temp_Id=Id;
				turn=false;
				tpath="";
				document.getElementById('sub').onclick=function(){
					alert("Select An Item !!!");
				}
			}
			else if(temp_Id==Id && turn==false){
				document.getElementById(Id).style.border='4px solid #3399CC';
				temp_Id=Id;
				turn=true;
				tpath=fpath;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';
				}
			}
			else if(temp_Id!=Id && turn==true){
				document.getElementById(temp_Id).style.border='none';
				document.getElementById(Id).style.border='4px solid #3399CC';
				temp_Id=Id;
				tpath=fpath;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';

				}
			}
			else if(temp_Id!=Id && turn==false){
				document.getElementById(Id).style.border='4px solid #3399CC';
				temp_Id=Id;
				tpath=fpath;
				turn=true;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					//document.getElementById('abc').style.display = 'block' : null;

				}
			}
			if(tpath!=""){
				insImage(t1path);
			}
					/*if(params.onSelect!=null)params.openFolderOnSelect=params.onSelect({"type":ftype,"path":fpath,"title":ftitle,"item":this},params);
		if(params.openFolderOnSelect==null)params.openFolderOnSelect=true;

		if(ftype=="folder" && params.openFolderOnSelect){
			params.currentPath=fpath;
			search();
		}*/
	}
	 	 
	search();
}