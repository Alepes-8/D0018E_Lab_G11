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
$part=intval($_GET['p']);

if($part == 1){

$pid = intval($_GET['a']);
$name = $_GET['b'];
$stock = intval($_GET['c']);
$cost = intval($_GET['e']);
$picture = $_GET['f'];
$disc = $_GET['g'];

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
       	$sql=" INSERT INTO products (Product_ID, product_name, cost, picture, disc) VALUES ('$pid','$name', '$cost', '$picture', '$disc')";
        $conn->query($sql);
	$stsql = " INSERT INTO stock (Product_ID, stock) VALUES ('$pid', '$stock')";
	$conn->query($stsql);
	
       
        $conn->close();

}
if($part == 2){  //Name

$pid = $_GET['a'];
$name = $_GET['b'];

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
        $sql=" UPDATE products SET product_name='$name' WHERE  Product_ID = '".$pid."' ";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

}
if($part == 3){  //Cost

$pid = $_GET['a'];
$cost = $_GET['b'];

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
        $sql=" UPDATE products SET cost='$cost' WHERE  Product_ID = '".$pid."' ";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

}
if($part == 4){	 //Picture

$pid = $_GET['a'];
$pic = $_GET['b'];

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
        $sql=" UPDATE products SET picture='$pic' WHERE  Product_ID= '".$pid."' ";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

}
if($part == 5){  //Disc

$pid = intval($_GET['a']);
$disch = $_GET['b'];

        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";
// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
       


	$sql="UPDATE products SET disc  = '$disch' WHERE Product_ID = '".$pid."'";        

        $conn->query($sql);
       
	$conn->close();

}
if($part == 6){  //delete product the asosiated products

	$pid = intval($_GET['a']);


        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";
	$dbname2 = "user";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
	$car = new mysqli($servername, $username, $password, $dbname2);        
// Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
   	}

// Delete comments and gradings	
	$sqlcomment=" Delete from grading_commenting where Product_ID = '".$pid."'";
        $conn->query($sqlcomment);

// Delete from stock
	$sqlstock=" Delete from stock  where Product_ID = '".$pid."'";
        $conn->query($sqlstock);	

// Delete from cart
	$sqlcart=" Delete from cart where Product_ID = '".$pid."'";
        $car->query($sqlcart);

// Delete from product
  	$sqlproduct=" Delete from products where Product_ID = '".$pid."'";
        $conn->query($sqlproduct);
        $conn->close();
	$car->close();
}
if($part == 7){

$pid = intval($_GET['a']);


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
        $back="Delete from orders where order_ID = '".$pid."'";
	$conn->query($back);
	
	$sql=" Delete from order_informastion where order_ID = '".$pid."'";
        $conn->query($sql);
        $conn->close();

}
if($part == 8){ //delete user

$name = $_GET['a'];


        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "user";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
	$cart="Delete from cart where username = '".$name."'";
	$conn->query($cart);
        $sql="Delete from login where username = '".$name."'";
        $conn->query($sql);
        $conn->close();

}
if($part == 9){   // edit stock
	$pid = intval($_GET['a']);
	$amount = intval($_GET['b']);
	echo $pid;
	echo $amount;
        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql="UPDATE stock SET stock = stock + $amount  WHERE Product_ID = '".$pid."'";

        $conn->query($sql);
        $conn->close();

}
if($part==10){   // delete a comment
	$comentid = intval($_GET['a']);
        
        $servername = "localhost";
        $username = "root";
        $password = "d0018eServer!";
        $dbname = "store";

        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql="delete from grading_commenting WHERE num = '".$comentid."'";

        $conn->query($sql);
        $conn->close();

}
?>

</body>
</html>
