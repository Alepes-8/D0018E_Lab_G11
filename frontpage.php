<!DOCTYPE html>
<html lang="en">
<head>

<title>Frontpage</title>
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

        <header>
                <h2>PhoneStore666</h2>
        </header>
        <aside>
                <p>We have had a goal in life. We wanted to spread and show the true love which one can only experience. If you have never known of this love, we will show you the way. Vintage phones wil never abanden you, they are eternal</p>
	<button onclick="document.location='cart.php'">Cart</button>	
        </aside>
        <section>
                <article>
               		<h1> Products </h1> 
			<?php
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
                                $sql="SELECT product_name, stock, overall_grading, cost, picture FROM products";
				$result = $conn->query($sql);
				

				while($row = $result->fetch_assoc()) {

        				echo  $row["product_name"].  "<br>";
        				
        				
					?>

 					<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>
						<div>
							<button id="<?php echo $row["product_name"]?>" onclick = "paymentpage(this.id)">Direct to buy</button>

							<form method="POST" action="">
								<input type="submit" id="<?php echo $row["product_name"]?>" name="data" value="Add to cart"/>
							</form>

							<button id="<?php echo $row["product_name"]?>" onclick = "productpage(this.id)">info</button>
							<a>
								<p>Cost: <?php echo $row["cost"]; ?>kr       Stock:<?php echo $row["stock"]; ?>st </p>
							</a>
						<div>
					<?php
        			
					echo "<br><br>";
				}
			
				if(isset($_POST['data'])){
                                        $sth=$conn->prepare("INSERT INTO cart(Content, Payment, Order_ID) SELECT product_name, cost, Product_ID FROM products WHERE product_name = id");
					echo '<script>alert(id)</script>';
					$sth->execute();
                                }
	
				mysqli_close($con);
			?>

	<script>
	function productpage(this_id){

        	window.location.href="productpage.php?q=" + this_id;

	}
	</script>

	<script>
	function paymentpage(this_id){
		window.location.href="payment.php?q=" + this_id;
	}
	</script>
                
		</article>
                <article>
                        <aside>
                                <form action="#">
                                        <label for="Search">Search:</label><br>
                                        <input type="text" id="Search" name="Search"><br>
                                        <input type="submit" value="search ">
                                        <input type="reset" value="reset">
                                </form>
                        </aside>
                        <nav>
                                <ul>
                                        <li><a href="#">Product1</a></li>
                                        <li><a href="#">Product2</a></li>
                                </ul>
                        </nav>
                </article>
        </section>
        <footer>
                <p>Informastion</p>
        </footer>

</body>
</html>


