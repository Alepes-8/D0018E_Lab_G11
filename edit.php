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
        $sql=" INSERT INTO products (Product_ID, product_name, stock, cost, picture, disc) VALUES ('$pid','$name', '$stock', '$cost', '$picture', '$disc')";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
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

$pid = $_GET['a'];
$disc = $_GET['b'];

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
        $sql=" UPDATE products SET disc='$disc' WHERE  Product_ID = '".$pid."' ";
        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

}
if($part == 8){  //Stock


$pid = $_GET['a'];
$stock = $_GET['b'];

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

	mysqli_select_db($con,"ajax_demo");
        $sql="SELECT * FROM stock where Product_ID='".$pid."'";
        $result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);

	
	$newstock =  "$row['stock'] + $stock";
        $sql=" UPDATE products SET stock='$newstock' WHERE  Product_ID = '".$pid."' ";
         
	if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
}
?>

</body>
</html>
