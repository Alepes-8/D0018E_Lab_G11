<html>
<head>

</head>
<body>

<?php
$uID = intval($_GET['a']);
$pID = intval($_GET['b']);
$pQ = intval($_GET['c']);

$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";
$dbname2 = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn2 = new mysqli($servername, $username, $password, $dbname2);

mysqli_select_db($conn2, "cart_test");
$sql = "SELECT id, Product_ID, quantity FROM cart WHERE id = '".$uID."'";
$result = $conn2->query($sql);

$row = $result->fetch_assoc();

if($row['quantity'] == 1){
        // subtract from quantity
        $sql = "DELETE FROM cart WHERE id = '".$uID."' AND Product_ID = '".$pID."'";
        $conn2->query($sql);
}
else{


        // remove from cart
        $sql = "UPDATE cart SET quantity = quantity - 1 WHERE id = '".$uID."' AND Product_ID = '".$pID."'";
        $conn2->query($sql);
}    

$conn->close();
$conn2->close();
?>

</body>
</html>
