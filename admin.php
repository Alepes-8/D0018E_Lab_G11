<html>
<head>
<script>

//call 
function tables(str) {
	if (str=="") {
		document.getElementById("txtHint").innerHTML="";
	return;
	}
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {
		if (this.readyState==4 && this.status==200) {
			document.getElementById("txtHint").innerHTML=this.responseText;
		}
	}
	xmlhttp.open("GET","gettables.php?q="+str,true);
	xmlhttp.send();
}
function editdata(part){
        window.location.href="editdata.php?p="+part;

}

</script>
</head>
<body>

<form>
	<select name="users" onchange="tables(this.value)">
	<option value="">Select a table:</option>
	<option value="1">Stock</option>
	<option value="2">Order</option>
	<option value="3">Products</option>
	
</select>
</form>

<br>

<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>

~                                                                                                                    

~                                                                                                                    

~                             
