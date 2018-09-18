var myPic=new Array();
var pi=0;
var temp_Id1="";
var turn1=true;

	function _(elementID){
		return document.getElementById(elementID);
	}
	function uploadFile(){
		var formdata=new FormData(document.getElementById("image_upload_form"));
		var file=_("image1").files[0];
		formdata.append("file1",file);   //no need this line
		var ajax=new XMLHttpRequest();
		
		ajax.addEventListener("error",myErrorHandler,false);
		ajax.addEventListener("load",myCompleteHandler,false);	
		ajax.open("POST","file_upload_parser.php");
		ajax.send(formdata);
						
	}
	
	function myCompleteHandler(event){
		//_("status").innerHTML=event.target.responseText;

			myPic[pi]=event.target.responseText;
			pi++;
			recent_file();
					
	}
	function myErrorHandler(event){
		_("error").innerHTML="no file select";	
	}

	function w(){
		for(j=0; j<myPic.length; j++){
			document.write(myPic[j]);
		}
	}
	/*function showRecentFile(){
	recent_file();
		for (k=0;k<myPic.length;k++){
			//var f=res.contents[i];
			var el=document.createElement("img");
			with(el){
				//setAttribute("title",f.fName);
				setAttribute("fPath",myPic[k]);
				//setAttribute("fType",f.fType);
				setAttribute("Id",k);
				className="itemft";
				id=k;
				width=200;
				height=200;
				src=myPic[k];
				//innerHTML= document.write("<img src="+f.fPath+">");
			}
			document.getElementById.("recentFile").appendChild(el);
			oddeven=(oddeven=="odd")?"even":"odd";
			el.onclick.selectItem();
		}
	}
	
	
	var temp_Id="";
	var turn=true;
	
	function selectItem(){
		//var ftype=this.getAttribute("fType");
		var fpath=this.getAttribute("fPath");
		//var ftitle=this.getAttribute("title");
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
	}*/
	
	function showRecentFile(params){
		
	if(params==null)params={};
	if(params.contentsDisplay==null)params.contentsDisplay=document.body;
	if(params.currentPath==null)params.currentPath="";
	if(params.filter==null)params.filter="";
	if(params.data==null)params.data="";

	var search=function(){
		
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

	var showFiles=function(){
		params.contentsDisplay.innerHTML="";
		
		for (ki=0;ki<myPic.length;ki++){
			//var f=res.contents[i];
			var el=document.createElement("img");
			with(el){
				//setAttribute("title",f.fName);
				setAttribute("fPath1",myPic[ki]);
				//setAttribute("fType",f.fType);
				setAttribute("Id1","k"+ki);
				className="itemft";
				id="k"+ki;
				width=200;
				height=200;
				src=myPic[ki];
				//innerHTML= document.write("<img src="+f.fPath+">");
			}
			params.contentsDisplay.appendChild(el);
			el.onclick=selectItem;
		}
	}
	
	
	
	
	var selectItem=function(){
		//var ftype=this.getAttribute("fType");
		var fpath1=this.getAttribute("fPath1");
		//var ftitle=this.getAttribute("title");
		var Id1=this.getAttribute("Id1");
		//var id = document.get.ElementById(Id).value();
		//document.getElementById(Id).style.border='2px solid #3399CC';
		//document.getElementById('sub').onclick=function(){
			//iImage(fpath)
			//};
		//setImagepath(fpath);
			//alert(fpath);
			
			if(temp_Id1==""){
				document.getElementById(Id1).style.border='4px solid #3399CC';
				temp_Id1=Id1;
				tpath=fpath1;
				
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';

				}
			}
			else if(temp_Id1==Id1 && turn1==true){
				document.getElementById(Id1).style.border='none';
				temp_Id1=Id1;
				turn1=false;
				tpath="";
				document.getElementById('sub').onclick=function(){
					alert("Select An Item !!!");
				}
			}
			else if(temp_Id1==Id1 && turn1==false){
				document.getElementById(Id1).style.border='4px solid #3399CC';
				temp_Id1=Id1;
				turn1=true;
				tpath=fpath1;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';
				}
			}
			else if(temp_Id1!=Id1 && turn1==true){
				document.getElementById(temp_Id1).style.border='none';
				document.getElementById(Id1).style.border='4px solid #3399CC';
				temp_Id1=Id1;
				tpath=fpath1;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display = 'none';

				}
			}
			else if(temp_Id1!=Id1 && turn1==false){
				document.getElementById(Id1).style.border='4px solid #3399CC';
				temp_Id1=Id1;
				tpath=fpath1;
				turn1=true;
				document.getElementById('sub').onclick=function(){
					iImage(tpath)
					document.getElementById('abc').style.display ='none';

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