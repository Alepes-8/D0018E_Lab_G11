<!DOCTYPE html>
<html lang="swe">



<head>
<title> payment </title>
<meta charset="utf-8">
<meta name="viewpoint" content="width=device-width, intial-scale=1">
<style>

{
        box-sizing:border-box;
}



section
{
        display: -webkit-flex;
        display: flex;
}

@media(max-width: 800px){
        section
        {
                -webkit-flex-direction: column;
                flex-direction: column;
        }
}



header
{
        font-family:;
        padding:10px;
        left:10px;
        top:40px;
}



article
{
        -website-flex: 3;
        -ms-flex: 3;
        flex: 3;
        padding: 10px;
}

nav
{
        -website-flex: 1;
        -ms-flex: 1;
        flex: 1;
        background-color: # 666;
        padding: 10px;
}

</style>
<script>
function addValue(part, pid, name, stock, cost, pic, disc ) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","edit.php?p="+part +"&a="+pid + "&b="+name + "&c="+stock + "&e="+cost + "&f="+pic + "&g="+disc,true);
    xmlhttp.send();
}

function edit(part, name, edit) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","edit.php?p="+part +"&a="+name + "&b="+edit,true);
    xmlhttp.send();
}

</script>
</head>
<body>
<?php

$part = intval($_GET['p']);

if($part==1){
?>
        <h1> Add Product</h1>
        <section>
                <article>   
                        <form action="/admin.php">
                                <label for="pid"> Product ID: </label> <br>
                                <input typ="number" id="pid" name="pid" maxlength="3" required="" value=""><br>

                                 <label for="pname"> Product name:</label><br>
                                <input type="name" id="pname" name="pname" required="" value=""><br>

                                <label for ="stock"> Stock </label><br>
                                <input type="number" id="stock" name="stock" required="" maxlength="16" value=""> <br>

                                <label for ="cost"> cost </label><br>
                                <input type="number" id="cost" name="cost" required="" maxlength="16" value=""> <br>

                                 <label for="picture">Picture url:</label><br>
                                <input type="name" id="picture" name="picture" required="" value=""><br>

                                <label for="disc"> Description: </label><br>
                                <input type="name" id="disc" name="disc" required="" value=""><br>


                                <input type ="submit" value="Submit" onclick="addValue(1, pid.value, pname.value, stock.value, cost.value, picture.value, disc.value)">
                        </form>
                </article>
        </section>
<?php
}
if($part==2){
?>
	<h1> Edit Product</h1>
        <section>
                <article>
        		<h2> Name </h2>
	                <form action="/admin.php">
                                <label for="editnumber1"> Product ID: </label> <br>
                                <input typ="number" id="editnumber1" name="editnumber1" maxlength="3" required="" value=""><br>

                                 <label for="editpname"> Product name:</label><br>
                                <input type="name" id="editpname" name="editpname" required="" value=""><br>

                                <input type ="submit" value="Submit" onclick="edit(2, editnumber1.value, editpname.value)">
                        </form>
			
			<h2> Cost </h2>
                        <form action="/admin.php">
                                <label for="editnumber1"> Product ID: </label> <br>
                                <input typ="number" id="editnumber1" name="editnumber1" maxlength="3" required="" value=""><br>

                                 <label for="editpname"> Product name:</label><br>
                                <input type="name" id="editpname" name="editpname" required="" value=""><br>

                                <input type ="submit" value="Submit" onclick="edit(3, editnumber1.value, editpname.value)">
                        </form>

                        <h2> Picture </h2>
                        <form action="/admin.php">

                                <label for="editnumber2"> Product ID: </label> <br>
                                <input typ="number" id="editnumber2" name="editnumber2" maxlength="3" required="" value=""><br>

                                 <label for="edisc"> Description:</label><br>
                                <input type="name" id="edisc" name="edisc" required="" value=""><br>

                                <input type ="submit" value="Submit" onclick="edit(4, editnumber2.value, edisc.value)">
                        </form>


			<h2> Description </h2>
			<form action="/admin.php">
	
                                <label for="editnumber2"> Product ID: </label> <br>
                                <input typ="number" id="editnumber2" name="editnumber2" maxlength="3" required="" value=""><br>

                                 <label for="edisc"> Description:</label><br>
                                <input type="name" id="edisc" name="edisc" required="" value=""><br>

                                <input type ="submit" value="Submit" onclick="edit(5, editnumber2.value, edisc.value)">
                        </form>
                </article>
        </section>
<?php
}
if($part == 3){
?>
			<h2> Stock Edit </h2>
			<form action="/admin.php">
                                <br>
                                <label for="stockid"> Id for the Stock change: </label> <br>
                                <input typ="number" id="stockid" name="stockid" maxlength="3" required="" value=""><br>

                                <label for="stock"> Edit stock: </label> <br>
                                <input typ="number" id="stock" name="stock" maxlength="3" required="" value=""><br>


                                <input type ="submit" value="Submit" onclick="edit(8, stockid.value, stock.value)">
                        </form>
 
<?php
}
?>
</body>
</html>
