<!DOCTYPE html>
<html>
<head>
<title>Product Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
{
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Style the header */
header
{
	font-family: "Courier New", Courier, monospace;
	padding: 20px;
	text-align: center;
	font-size: 35px;
	color: black;
}
section {
	display: -webkit-flex;
	display: flex;
}
nav
{
	background: #ccc;
	padding: 20px;
}

/* Style the list inside the menu */
nav ul
{
	list-style-type: none;
	padding: 0;
}

/* Style the content */
article
{
        -webkit-flex: 3;
        -ms-flex: 3;
        flex: 3;
        background-color: #f1f1f1;
        padding: 10px;
        text-align: center;
}

/* Style the footer */
footer
{
        background-color: #777;
        padding: 10px;
        text-align: center;
        color: white;
}
aside {
	background-color: #777;
	padding: 10px;
	text-align: left;
	color: Black;
}

@media (max-width: 1200px) {
  section {
    -webkit-flex-direction: column;
    flex-direction: column;
  }
}
</style>
</head>

<body>
<h1>
Phonestore-666 Product Page.
</h1>
<article>
<?php


$q = $_REQUEST["q"];

//Login credentials
$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";

//Gets parameter from url
?>

<h2> You are currently looking at the <?php echo $q ?> product </h2>
<?php	
		$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
		if ($conn->connect_error) {
                	die("Connection failed: " . $conn->connect_error);
		}

	mysqli_select_db($con,"ajax_demo");
        $sql="SELECT product_name, stock, overall_grading, cost, picture, disc FROM products WHERE product_name = '".$q."'";
        $result = $conn->query($sql);

	$row = $result->fetch_assoc();
?>
<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>

<p>
Product rating: <?php echo $row["overall_grading"] ?> <br> 
Amount of products left in stock: <?php echo $row["stock"] ?> <br>
Description of product: <?php echo $row["disc"] ?> <br>
Price of product: <?php echo $row["cost"] ?> <br>	
</p>


</article>
</body>
</html>
