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

//Begin transaction
	$conn->autocommit(FALSE);
	$BeginTrans = "START TRANSACTION";
	$conn->query($BeginTrans);
 
// add order informastion
        $sql=" INSERT INTO order_informastion ( name, h_address, mail, c_name, b_address, card, cvv, date) VALUES ('$name','$h_address','$email','$c_name','$b_address', '$card', '$cvv', '$date')";
	$t1 = $conn->query($sql); //added t1	

// add informastion to the order table
	mysqli_select_db($con,"ajax_demo");
	$sql2 = "SELECT max(order_ID) FROM order_informastion";
	$result_set2 = mysqli_query($conn,$sql2);
    	$rowsss = mysqli_fetch_array($result_set2);
	$rowB = $rowsss['0'];
		
	$ordersql=" INSERT INTO orders (order_ID, order_quantity, Product_ID) VALUES ('$rowB','1','$pro')";
        $t2 = $conn->query($ordersql); //added t2

// add the total cost
 	mysqli_select_db($conn,"ajax_demo");
        $sqlcost="SELECT cost FROM products where Product_ID='".$pro."'";
        $cost = $conn->query($sqlcost);

        $rowC = $cost->fetch_assoc();
	$total = $rowC['cost'];
	$money = "UPDATE order_informastion SET cost = $total  WHERE order_ID = '".$rowB."'";
        $t3 = $conn->query($money); //added t3	
	
// delete from stock
	mysqli_select_db($conn,"ajax_demo");
        $sqlstock="SELECT stock FROM stock where Product_ID='".$pro."'";
        $stock = $conn->query($sqlstock);
	$rowS = $stock->fetch_assoc();
	if($rowS['stock']!=0){
		$delsto="UPDATE stock SET stock = stock - 1  WHERE Product_ID = '".$pro."'";
        	$t4 = $conn->query($delsto); //added t4	
	}
//End Transaction, check if something failed and need to rollback or we can commit
//Om något inte funkar av någon anledning då är det ända som blivit tillagt är transactions
if ($t1 and $t2 and $t3 and $t4) {
	$commit = "COMMIT";
   	$conn->query($commit);
        echo "Commit done.... <br>";
	} else {
		$rollback = "ROLLBACK";
    		$conn->query($rollback);
		echo "Error, rolling back  <br>";
	}
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

//Begin transaction
        $conn->autocommit(FALSE);
        $car->autocommit(FALSE);
	$BeginTrans = "START TRANSACTION";
        $conn->query($BeginTrans);
	$car->query($BeginTrans);


// Insert into order_informastion
        $sql=" INSERT INTO order_informastion ( name, h_address, mail, c_name, b_address, card, cvv, date) VALUES ('$name','$h_address','$email','$c_name','$b_address', '$card', '$cvv', '$date')";
        $t1 = $conn->query($sql); //added t1

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
	
	mysqli_select_db($conn,"ajax_demo");
        $sqlstock="SELECT stock FROM stock where Product_ID='".$pro."'";
        $stock = $conn->query($sqlstock);
       

        while($row = $result->fetch_assoc()) {
        	$pro = $row['Product_ID'];
		$quant = $row['quantity'];
		$ordersql=" INSERT INTO orders (order_ID, order_quantity, Product_ID) VALUES ('$rowB','$quant','$pro')";
		$t2 = $conn->query($ordersql); //added t2

//delete from stock
       	 	$sqlstock="SELECT stock FROM stock where Product_ID='".$pro."'";
        	$stock = $conn->query($sqlstock);
		$rowS = $stock->fetch_assoc();
		$checks = $rowS['stock']-$quant;	
		if($checks>=0){  	
			$delsto="UPDATE stock SET stock = stock - $quant  WHERE Product_ID = '".$pro."'";
                	$t3 = $conn->query($delsto); //added t3
		}else{
			$delsto="UPDATE stock SET stoc = stock - $quant  WHERE Product_ID = '".$pro."'";
                        $t3 = $conn->query($delsto); //added t3
			break;
		
		}
	}

// Sum of the cost of the buy
 	$total = 0;
	

	mysqli_select_db($car,"ajax_demo");
        $sqltotal="SELECT Product_ID, quantity FROM cart where id='".$id."'";
        $part = $car->query($sql); //Är det meningen att det ska stå $sql och inte $sqltotal???????

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
	$t4 = $conn->query($money); //added t4	
	
// Remove from the cart
   	$del = "delete from cart where id ='".$id."'";
        $t5 = $car->query($del); //added t5

//End of transaction, med detta borde transactions vara klara. Dock måste queries skrivas om lite för att få det att funka 100 procent. 
if ($t1 and $t2 and $t3 and $t4 and $t5) {
        $commit = "COMMIT";
        $conn->query($commit);
        $car->query($commit);
	echo "Commit done.... <br>";
        } else {
                $rollback = "ROLLBACK";
                $conn->query($rollback);
                $car->query($rollback);
		
	 	
		echo "Error, rolling back  <br>";
        }
        $conn->close();
	$car->close();
}
?>

</body>
</html>
