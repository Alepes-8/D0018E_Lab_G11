<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
$uID = intval($_GET['a']);
$pID = intval($_GET['b']);
$pCost = intval($_GET['c']);

$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";
$dbname2 = "user";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//create second connection
$conn2 = new mysqli($servername, $username, $password, $dbname2);

mysqli_select_db($conn2, "cart_test");
$sql = "SELECT  Product_ID, quantity FROM cart WHERE id = '".$uID."'";
$result = $conn2->query($sql);

$maybe = 0;

while($row = $result->fetch_assoc()){

	echo $row['Product_ID'];
	echo "$pID";

	if($row["Product_ID"] == "$pID"){
		echo "sucess";
		$maybe = 1;
			// add to quantity
		$sql = "UPDATE cart SET quantity = quantity + 1 WHERE Product_ID = '".$pID."' and id='".$uID."'";
                $conn2->query($sql);
		break;
	}
	echo "<br>";
}
if($maybe == 0){
	// add to cart
	$sql = "INSERT INTO cart (id, Product_ID, cost, quantity) VALUES ('$uID', '$pID', '$pCost', 1)";
        $conn2->query($sql);
}

$conn->close();
$conn2->close();
?>
</body>
</html>
