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

$id = intval($_GET['a']);


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

        $sql=" DELETE from order_informastion where order_ID ='".$id."'";
	                   
        if ($conn->query($sql) === TRUE) {
                echo "Successfully deleted " . $o_id . "<br>";
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();

?>
</body>
</html>
