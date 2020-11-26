<!DOCTYPE html>

<html>
<head>
<style>

table{
        width: 1000px;
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

if($q==1){
        mysqli_select_db($con,"ajax_demo");
        $sql="SELECT * FROM stock";
        $result = mysqli_query($con,$sql);

        echo "<table>
        <tr>
        <th>p_ID</th>
        <th>s_amount</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['p_ID'] . "</td>";
                echo "<td>" . $row['s_amount'] . "</td>";
                echo "</tr>";
        }
        echo "</table>";
        mysqli_close($con);
}

if($q==2){
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
	<h1> Take away order </h1>
	<form >

                                <label for ="deleteID"> Order_ID(Order which you wish to take away): </label><br>
                                <input type="number" id="deleteID" name="deleteID" required=""  value=""><br>

                                <button type="submit" id="delete" onclick="delete(deleteID.value)">
                                Submit </button>
        </form>	

<?php
      
        mysqli_close($con);
}
if($q==3){

	mysqli_select_db($con,"ajex_demo");
        $sql="SELECT * FROM products";
        $result = mysqli_query($con,$sql);
		
	 echo "<table>

        <tr>
        <th>Product_ID</th>
        <th>product_name</th>
	<th>stock</th>
        <th>overall_grading</th>
	<th>cost</th>
        <th>Descripton</th>
        </tr>";



        while($row = mysqli_fetch_array($result)) {

                echo "<tr>";

                echo "<td>" . $row['Product_ID'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
         	echo "<td>" . $row['stock'] . "</td>";
                echo "<td>" . $row['overall_grading'] . "</td>";
                echo "<td>" . $row['cost'] . "</td>";
                echo "<td>" . $row['disc'] . "</td>";
		echo "</tr>";

        }
		

        echo "</table>";
        echo "<br> <br>";
?>	
		

	<button id="proadd" onclick="editdata(1)">Add product</button>
	<button id="proedit" onclick=" editdata(2)"> Edit </button>	
	<button id="stockedit" onclick=" editdata(3)"> add/sub stock </button>	 
        
	

<?php

	mysqli_close($con);
}

?>
</body>
</html>
