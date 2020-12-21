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
<html>
<head>
<title>Cart</title>
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
                	<h2>PhoneStore666</h2>
        	</header>
	</a>
	
	<button onclick= "document.location= 'logout.php'"> Logout </button>

        <section>
                <article>

                        <h1> Your cart </h1>
			<article>


                        <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "d0018eServer!";
                                $dbname = "user";
				$dbname2 = "store";

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);
                        	// Check connection
                                if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                }
				//Create second connection
				$conn2 = new mysqli($servername, $username, $password, $dbname2);



                                mysqli_select_db($conn,"ajax_demo");
                                //$sql="SELECT id, Product_ID, cost, quantity FROM cart WHERE id = '".$_SESSION['id']."'";
                                
				$sql="SELECT user.cart.id, user.cart.Product_ID, user.cart.cost, user.cart.quantity, store.products.product_name 
				FROM user.cart 
				RIGHT JOIN store.products 
				ON user.cart.Product_ID = store.products.Product_ID 
				WHERE id = '".$_SESSION['id']."'";
				
				$result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {

					echo  $row["product_name"]. "<br";                                      

					?>
					<div>
                                                        <a>
							
							<button id="<?php echo $_SESSION["id"]?>" onclick="addToCart(this.id, <?php echo $row["Product_ID"]?>, <?php echo $row["quantity"]?>); pageReload();">Add</button>
								
                                                        <button id="<?php echo $_SESSION["id"]?>" onclick="removeFromCart(this.id, <?php echo $row["Product_ID"]?>, <?php echo $row["quantity"]?>); pageReload();">Subtract</button>
							
							<button id="<?php echo $row["Product_ID"]?>" onclick= "productpage(this.id)">info</button>
                                                        
							<p>Cost: <?php echo $row["cost"] * $row["quantity"]; ?>kr       Quantity:<?php echo $row["quantity"]?>st </p>

                                                        </a>
                                        <div>
					<?php 
                                        echo "<br><br>";
                                }

                                mysqli_close($con);

                        ?>

			<button id="payall" onclick = "paymentpage(2, <?php echo $_SESSION['id'] ?>)">Processed to checkout</button>

			<script>
			function productpage(this_id){
				window.location.href="productpage.php?q=" + this_id;
			}
			
			function pageReload(){
				setTimeout(function(){window.location.href = window.location.href;}, 300);
			}
			</script>

			<script>
			function addToCart(uID, pID, pQ){
                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function(){
                                                if(this.readyState == 4 && this.state == 200){
                                                        document.getElementById("txtHint").innerHTML = this.responseText;
                                                }
                                        };
                                        xmlhttp.open("GET", "addtocart.php?a="+uID + "&b="+pID + "&c="+pQ, true);
                                        xmlhttp.send();
                        }
				
			function removeFromCart(uID, pID, pQ){
				var xmlhttp = new XMLHttpRequest();
                		xmlhttp.onreadystatechange = function(){
                        		if(this.readyState == 4 && this.state == 200){                                                                                  
						document.getElementById("txtHint").innerHTML = this.responseText;
                        		}
                		};
                		xmlhttp.open("GET", "removefromcart.php?a="+uID + "&b="+pID + "&c="+pQ, true);
                		xmlhttp.send();
			}
			</script>
			        		
	</article>
              
        </section>
        <footer>
                <p>Contact: Oliver, Johan or alex for futher questions</p>
        </footer>

	 <script>



        function paymentpage(part, this_id){
                window.location.href="payment.php?q="+ part + "&p="+this_id;
        }
        </script>
</body>

</html>


