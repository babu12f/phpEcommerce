

// This is a javascript file named wysiwyg.js
function iFrameOn(){
	richTextField.document.designMode = 'On';
}
function iBold(){
	richTextField.document.execCommand('bold',false,null); 
}
function iUnderline(){
	richTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	richTextField.document.execCommand('italic',false,null); 
}
function iFontSize(){
	var size = prompt('Enter a size 1 - 7', '');
	richTextField.document.execCommand('FontSize',false,size);
}
function iForeColor(val){
	//var color = prompt('Define a basic color or apply a hexadecimal color code for advanced colors:', '');
	var color = document.getElementById("colorChoice").value; 
	richTextField.document.execCommand('ForeColor',false,color);
}
function iHorizontalRule(){
	richTextField.document.execCommand('inserthorizontalrule',false,null);
}
function iUnorderedList(){
	richTextField.document.execCommand("InsertOrderedList", false,"newOL");
}
function iOrderedList(){
	richTextField.document.execCommand("InsertUnorderedList", false,"newUL");
}
function iLink(){
	var linkURL = prompt("Enter the URL for this link:", "http://"); 
	richTextField.document.execCommand("CreateLink", false, linkURL);
}
function iUnLink(){
	richTextField.document.execCommand("Unlink", false, null);
}
function iImage(src){
	//var imgSrc = prompt('Enter image location', '');
	var imgSrc=src;
	var table = document.getElementById('product-review');
	//var row = table.insertRow(1);
	
	var row = table.insertRow(table.rows.length);

	row.innerHTML='<tr><td style="width:20%"><img src='+src+' alt="animal1" class="img-responsive"></td><td><input type="text" name="productPic[]" class="form-control m-t-10" value='+src+' readonly></td><td><input class="mainPic" onclick="mainPicSelect(this)" type="radio" name="productProfileImage[]" value="1" class="m-t-10"></td><td class="text-center"><button type="button" class="delete-img btn btn-sm btn-default m-t-10"  onclick="removeImage(this)"><i class="fa fa-times-circle"></i> Remove</button></td></tr>';


	//row.innerHTML='<td><input name="productPic[]" type="text"  /></td>';
	document.getElementById('mainImageIndex').value = "";
	document.getElementById('mainImageSrc').value = "";
	
	var x = document.getElementsByName('productProfileImage[]');
	
	for( i=0; i<x.length; i++ ){
		x[i].checked = false;
	}
	
} 

function removeImage(o){
	var p=o.parentNode.parentNode;
         p.parentNode.removeChild(p);
		 
	document.getElementById('mainImageIndex').value = "";

	document.getElementById('mainImageSrc').value = "";
	
	var x = document.getElementsByName('productProfileImage[]');
	
	for( i=0; i<x.length; i++ ){
		x[i].checked = false;
	}
	
}

function removeCartProduct(o){
	var p=o.parentNode.parentNode;
    p.parentNode.removeChild(p);
	//remove_cart_and_update();
    return false;	
}
function remove_cart_and_update(){
	var form_update_cart = document.getElementById('updataCartForm');
	form_update_cart.submit();
}



function submit_form(){
	var theForm = document.getElementById("formpic");
	theForm.submit();
}
function mainPicSelect(o){
	var p=o.parentNode.parentNode;
	var x=document.getElementById('mainImageIndex');
	x.value=p.rowIndex-1;

	var src = document.getElementById('mainImageSrc');
	var y = p.childNodes[1];
	var z = y.childNodes[0];
	
	//alert(z.innerHTML);
	//z.setAttribute("value",20);
	
	src.value = z.getAttribute("value");
}

function edit_mainPicSelect(o){
	
	var p = o.parentNode.parentNode;
	var index = p.rowIndex-1;
	
	var form = document.getElementById("form1");
	
	var product_pic = form.elements["productPic[]"];
	var product_pic_len = form.elements["productPic[]"].length;
	
	var main_pic_index = document.getElementById('mainImageIndex');
	main_pic_index.value = index;

	var src = document.getElementById('mainImageSrc');
	
	if(!product_pic_len){
		src.value = form.elements["productPic[]"].value;
	}else{
		src.value = product_pic[index].value;
	}

}

function incermentCartProduct(o){
	var p = o.parentNode;
	var input = p.childNodes[3];
	var val = input.getAttribute("value");
	val= parseInt(val);
	val+=1;

	input.setAttribute("value",val);
	return false;

	/*var c = p.childNodes;
    var txt = "";
    var i;
    for (i = 0; i < c.length; i++) {
        txt = txt + c[i].nodeName + " ";
    }
    alert(txt);*/
}
function decermentCartProduct(o){
	var p = o.parentNode;
	var input = p.childNodes[3];
	var val = input.getAttribute("value");
	val= parseInt(val);
	val-=1;
	if(val>=0){
		input.setAttribute("value",val);
	}else{
		alert('Nagative Number Allowed');
	}
	return false;
}

function backToShopping(){
	history.go(-2);
	return false;
}

function loadMoreImage(){
	loadImage();
}

function loadImage(){

	var showFiles =function(){
		var oddeven="odd";
		
		//res.contents.length
		var start = document.getElementById("offsetValue").value;
		start = parseInt(start);
		var end = start+10;
		 document.getElementById("offsetValue").value=end;
		//alert(start);
		
		for (i=start; i< end && i<allImageStore.contents.length; i++){
			var f=allImageStore.contents[i];
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
			PictureBox.appendChild(el);
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
	}
	showFiles();
}


