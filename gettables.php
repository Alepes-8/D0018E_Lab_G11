<!DOCTYPE html>

<html>
<head>
<style>

table{
        width: 800px;
        border-collapse: collapse;
}

table, td, th{
        border: 1px solid black;
        padding: 5px;
}

th{text-align: left;}

</style>

</head>

<body>
<?php

$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";

$q = intval($_GET['q']);

$con = mysqli_connect($servername, $username, $password, $dbname);
if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
}

$dbname2 = "user";

$user = mysqli_connect($servername, $username, $password, $dbname2);
if (!$user) {
        die('Could not connect: ' . mysqli_error($con));
}

if($q==2){
	?>
	<h1> Order Informastion </h1>
	<?php
	mysqli_close($user);

        mysqli_select_db($con,"ajex_demo");
        $sql="SELECT * FROM order_informastion";
        $result = mysqli_query($con,$sql);
       
        echo"<table>
        <tr>
        <th>Order_ID</th>
	<th>Name</th>
	<th>Address</th>
	<th>Mail</th>
	<th>Cardholder</th>
        <th>Billing Address</th>
        <th>Card Number</th>
	<th>CVV</th>
	<th>Date</th>
	<th>Cost</th>
	</tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['order_ID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['h_address'] . "</td>";
		echo "<td>" . $row['mail'] . "</td>";
		echo "<td>" . $row['c_name'] . "</td>" ;
		echo "<td>" . $row['b_address'] . "</td>" ;
                echo "<td>" . $row['card'] . "</td>";
		echo "<td>" . $row['cvv'] . "</td>";
		echo "<td>" . $row['date'] . "</td>";			
		echo "<td>" . $row['cost'] . "</td>";
		echo "</tr>";
        }

	echo "</table>";
?>
	<h3> Take away order </h3>
	<form >

                                <label for ="delID"> Order_ID(Order which you wish to take away): </label><br>
                                <input typ="number" id="delID" name="delID" required=""  value="" maxlength ="8"><br>

                                <button type="submit" id="takeaway" onclick="orderdel(7, delID.value)">
                                Submit </button>
        </form>	

<h1> Products ordered </h1>
<?php
	
 mysqli_select_db($con,"ajex_demo");
        $sql="SELECT * FROM orders";
        $result = mysqli_query($con,$sql);

        echo"<table>
        <tr>
        <th>Order_ID</th>
        <th>Quantity</th>
        <th>Product_ID</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['order_ID'] . "</td>";
                echo "<td>" . $row['order_quantity'] . "</td>";
                echo "<td>" . $row['Product_ID'] . "</td>";
                echo "</tr>";
        }

        echo "</table>";
	      
        mysqli_close($con);
}
if($q==3){
	?>
	<h1> Store Products </h1>
	<?php

	mysqli_close($user);

	mysqli_select_db($con,"ajex_demo");
        $sql="SELECT * FROM products";
        $result = mysqli_query($con,$sql);
		
	 echo "<table>

        <tr>
        <th>Product_ID</th>
        <th>product_name</th>
	<th>cost</th>
        <th>Descripton</th>
        </tr>";



        while($row = mysqli_fetch_array($result)) {

                echo "<tr>";

                echo "<td>" . $row['Product_ID'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['cost'] . "</td>";
                echo "<td>" . $row['disc'] . "</td>";
		echo "</tr>";

        }
		

        echo "</table>";
        
?>	
		

	<button id="proadd" onclick="editdata(1)">Add product</button>
	<button id="proedit" onclick=" editdata(2)"> Edit </button>	
        <button id="stockedit" onclick=" editdata(4)"> delete </button>        
	<br><br>	
	<h1> Store Stock </h1>
<?php

	

	

	mysqli_select_db($con,"ajax_demo");
        $sql="SELECT * FROM stock";
        $result = mysqli_query($con,$sql);

        echo "<table>
        <tr>
        <th>Product_ID</th>
        <th>stock</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['Product_ID'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
	?>
	<button id="stockedit" onclick=" editdata(3)"> add/sub stock </button>
	<br> <br>
	<h1> Comments </h1>
	<?php
		
	
        mysqli_select_db($con,"ajax_demo");
        $sql="SELECT * FROM grading_commenting";
        $result = mysqli_query($con,$sql);

        echo "<table>
        <tr>
	<th>Number</th>
        <th>Product_ID</th>
        <th>name</th>
	<th>grading</th>
	<th>comment</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
		echo "<td>" . $row['num'] . "</td>";
                echo "<td>" . $row['Product_ID'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['grading'] . "</td>";
		echo "<td>" . $row['comment'] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
        ?>
       <form >

                                <label for ="delID"> Delete grading/comment (write the number of the comment/grading): </label><br>
                                <input type="number" id="delID" name="delID" required=""  value="">

                                <button type="submit" id="takeaway" onclick="orderdel(10, delID.value)">
                                Submit </button>
        </form>
        <?php	

        mysqli_close($con);
}
if($q == 4){
	?>
	<h1> User informastion </h1>
	<?php
	mysqli_select_db($user,"ajex_demo");
        $sql="SELECT * FROM login";
        $result = mysqli_query($user,$sql);

        echo"<table>
        <tr>
        <th>username</th>
        <th>password</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "</tr>";
        }

        echo "</table>";

	?>
        <h3> Delete user </h3>
        <form >
		<label for ="usedel"> Username(write the user name to delete): </label><br>
                <input type="name" id="usedel" name="usedel" required="" maxlength = "45" size ="50" value=""><br>

                <button type="submit" id="takeaway" onclick="orderdel(8, usedel.value)"> Submit </button>
        </form>
	
<?php
	
	mysqli_close($user);
	 mysqli_close($con);
}
?>
</body>
</html>
