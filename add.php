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

        $sql=" INSERT INTO order_informastion ( name, h_address, mail, c_name, b_address, card, cvv, date) VALUES ('$name','$h_address','$email','$c_name','$b_address', '$card', '$cvv', '$date')";

        if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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
?>
</body>
</html>
