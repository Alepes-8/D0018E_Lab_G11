<html>
<head>

<style>
table{
        width: 300px;
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
$version = intval($_GET['q']);
if($version == 1){
	$name = $_GET['a'];
	$h_address = $_GET['b'];
	$email = $_GET['c'];
	$c_name = $_GET['d'];
	$b_address = $_GET['e'];
	$card = $_GET['f'];
	$cvv = intval($_GET['g']);
	$date = $_GET['h'];
	$pro = intval($_GET['i']);

        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";


// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

// add order informastion
        $sql=" INSERT INTO order_informastion ( name, h_address, mail, c_name, b_address, card, cvv, date) VALUES ('$name','$h_address','$email','$c_name','$b_address', '$card', '$cvv', '$date')";
	$conn->query($sql);	

// add informastion to the order table
	mysqli_select_db($con,"ajax_demo");
	$sql2 = "SELECT max(order_ID) FROM order_informastion";
	$result_set2 = mysqli_query($conn,$sql2);
    	$rowsss = mysqli_fetch_array($result_set2);
	$rowB = $rowsss['0'];
		
	$ordersql=" INSERT INTO orders (order_ID, order_quantity, Product_ID) VALUES ('$rowB','1','$pro')";
        $conn->query($ordersql);

// add the total cost
 	mysqli_select_db($conn,"ajax_demo");
        $sqlcost="SELECT cost FROM products where Product_ID='".$pro."'";
        $cost = $conn->query($sqlcost);

        $rowC = $cost->fetch_assoc();
	$total = $rowC['cost'];
	$money = "UPDATE order_informastion SET cost = $total  WHERE order_ID = '".$rowB."'";
        $conn->query($money);	
	
// delete from stock
	$delsto="UPDATE stock SET stock = stock - 1  WHERE Product_ID = '".$pro."'";
        $conn->query($delsto);	

	$conn->close();
}
if($version == 2){
	$id =  intval($_GET['a']);
	$name = $_GET['b'];
        $stock =  intval($_GET['c']);
	$cost =  intval($_GET['d']);
        $pic =  $_GET['e'];
        $dics = $_GET['f'];

        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql=" INSERT INTO products ( Product_ID, product_name, stock, cost, picture, disc) VALUES ('$id','$name','$stock','$cost','$pic', '$disc')";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
}
if($version == 3){

	$id = intval($_GET['a']);	
        $name = $_GET['b'];
        $grade =  intval($_GET['c']);
        $com =  $_GET['d'];
        
        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql=" INSERT INTO grading_commenting (Product_ID, name, grading, comment) VALUES ('$id','$name','$grade', '$com')";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
}
if($version == 4){  // edit database when buying a product
        $name = $_GET['a'];
        $h_address = $_GET['b'];
        $email = $_GET['c'];
        $c_name = $_GET['d'];
        $b_address = $_GET['e'];
        $card = $_GET['f'];
        $cvv = intval($_GET['g']);
        $date = $_GET['h'];
        $id = intval($_GET['i']);

        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";
	$dbname2 = "user";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        $car =	new mysqli($servername, $username, $password, $dbname2);


// Insert into order_informastion
        $sql=" INSERT INTO order_informastion ( name, h_address, mail, c_name, b_address, card, cvv, date) VALUES ('$name','$h_address','$email','$c_name','$b_address', '$card', '$cvv', '$date')";
        $conn->query($sql);

// Get order_ID from order_informastion
 	mysqli_select_db($conn,"ajax_demo");
        $sql2 = "SELECT max(order_ID) FROM order_informastion";
        $result_set2 = mysqli_query($conn,$sql2);
        $rowsss = mysqli_fetch_array($result_set2);
        $rowB = $rowsss['0'];
	
// Insert into orders with the order_ID for the latest inserted order
 	mysqli_select_db($car,"ajax_demo");
        $sql="SELECT Product_ID, quantity FROM cart where id='".$id."'";
        $result = $car->query($sql);

        while($row = $result->fetch_assoc()) {
        	$pro = $row['Product_ID'];
		$quant = $row['quantity'];
		$ordersql=" INSERT INTO orders (order_ID, order_quantity, Product_ID) VALUES ('$rowB','$quant','$pro')";
		$conn->query($ordersql);

//delete from stock
          	$delsto="UPDATE stock SET stock = stock - $quant  WHERE Product_ID = '".$pro."'";
                $conn->query($delsto);
	}

// Sum of the cost of the buy
 	$total = 0;
	

	mysqli_select_db($car,"ajax_demo");
        $sqltotal="SELECT Product_ID, quantity FROM cart where id='".$id."'";
        $part = $car->query($sql);

 	while($rowM = $part->fetch_assoc()) {
		$usep = $rowM['Product_ID'];
		$amount = $rowM['quantity'];

                mysqli_select_db($conn,"ajax_demo");

                $sql="SELECT cost FROM products where Product_ID='".$usep."'";

                $result = $conn->query($sql);
		
		$rowT = $result->fetch_assoc();
	
	
                $total += $rowT['cost'] * $rowM['quantity'];
	
	}
		
	$money = "UPDATE order_informastion SET cost = $total  WHERE order_ID = '".$rowB."'";
	$conn->query($money);	
	
// Remove from the cart
   	$del = "delete from cart where id ='".$id."'";
        $car->query($del);

        $conn->close();
	$car->close();
}
?>
</body>
</html>
