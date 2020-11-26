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
	<header>

                <h2>PhoneStore666</h2>

        </header>
        <section>
                <article>

                        <h1> Your cart </h1>
			<article>


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
                                        
                                                <div>
							<a>
                                                       	amount in cart:
                                                        <form method="POST" action="">
                                                                <input type="submit" id="<?php echo $row["product_name"]?>" name="data" value="Add to cart"/>
                                                       
                                                        <button id="<?php echo $row["product_name"]?>" onclick = "productpage(this.id)">Subtract</button>
                                                        <button id="<?php echo $row["product_name"]?>" onclick = "productpage(this.id)">info</button>
							</form>
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

			<button id="payall" onclick = "paymentpage()">Processed to checkout</button>
        		
	</article>
              
        </section>
        <footer>
                <p>Contact: Oliver, Johan or alex for futher questions</p>
        </footer>
</body>

</html>


