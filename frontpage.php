<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


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

        <a href="/frontpage.php">
                <header>
                        <h1>PhoneStore666 </h1>
                </header>
        </a>
	
        <aside>
                <p>We have had a goal in life. We wanted to spread and show the true love which one can only experience. If you have never known of this love, we will show you the way. Vintage phones wil never abanden you, they are eternal</p>
	<button onclick="document.location='cart.php'">Cart</button>	
        <button onclick="document.location='logout.php'">Logout</button>
	</aside>
        <section>
                <article>
               		<h1> Products </h1> 
			<?php
				$servername = "localhost";
                                $username = "root";
                                $password = "d0018eServer!";
                                $dbname = "store";
				$dbname2 = "user";
			
				// Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);
                        	// Check connection
                                if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                }

								
	
				mysqli_select_db($conn,"ajax_demo");
                                $sql="SELECT Product_ID, product_name, cost, picture FROM products";
				$result = $conn->query($sql);
				
				while($row = $result->fetch_assoc()) {
					$pro = $row['Product_ID'];	
				    	mysqli_select_db($conn,"ajax_demo");
                                	$sqlstock="SELECT stock FROM stock where Product_ID = '".$pro."'";
                                	$amount = $conn->query($sqlstock); 
					$rowS = $amount->fetch_assoc();


        				echo  $row["product_name"].  "<br>";
					?>

 					<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>
						<div>
							<button id="<?php echo $row["Product_ID"]?>" onclick = "paymentpage(1, this.id)">Direct to buy</button>
							
						 	<button id="<?php echo $_SESSION["id"]?>" onclick= "addToCart(this.id, <?php echo $row["Product_ID"]?>, <?php echo $row["cost"]?>)">Add to cart</button>						
							<button id="<?php echo $row["Product_ID"]?>" onclick = "productpage(this.id)">info</button>
							<a>
								<p>Cost: <?php echo $row["cost"]; ?>kr       Stock:<?php echo $rowS['stock']; ?>st </p>
							</a>
						<div>
					<?php
        			
					echo "<br><br>";
				}
				mysqli_close($con);
			?>

	<script>
	function productpage(this_id){

        	window.location.href="productpage.php?q=" + this_id;

	}
	</script>

	<script>
	function paymentpage(part, this_id){
		window.location.href="payment.php?q=" + part + "&p=" + this_id;
	}
	</script>
	
	<script>
	function addToCart(uID, pID, pCost){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.state == 200){
				document.getElementById("txtHint").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "addtocart.php?a="+uID + "&b="+pID + "&c="+pCost, true);
		xmlhttp.send();
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

                                mysqli_select_db($conn,"ajax_demo");
                                $sql="SELECT Product_ID, product_name, cost, picture FROM products";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                        ?>
                                                
                               			<li><a id="<?php echo $row['Product_ID']?>"  onclick = "productpage(this.id)"><?php echo $row["product_name"]?></a></li>                     
                                                
                                        <?php

                                        echo "<br>";
                                }
                                mysqli_close($con);
                        ?>
                               
                               </ul>
                        </nav>
                </article>
        </section>
        <footer>
                <p> Contact Alex, Johan, or Oliver for any further questions </p>
        </footer>

</body>
</html>


