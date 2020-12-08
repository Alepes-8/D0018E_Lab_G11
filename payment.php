
<nt </title>
<meta charset="utf-8">
<meta name="viewpoint" content="width=device-width, intial-scale=1">
<style>

{
        box-sizing:border-box;
}

section
{
	display: -webkit-flex;
        display: flex;
}


@media(max-width: 800px){
        section
        {
                -webkit-flex-direction: column;
                flex-direction: column;
        }
}



header
{
        font-family: "Courier New", Courier, monospace;
        padding: 20px;
        text-align: center;
        font-size: 35px;
        color: black;
}


article
{
        -website-flex: 3;
        -ms-flex: 3;
        flex: 3;
        padding: 10px;
	text-align: center;
}


nav
{
        -website-flex: 1;
        -ms-flex: 1;
        flex: 1;
        background-color: # 666;
        padding: 10px;
}

</style>
<script>

function addValue(add, name, adress, email, cardh, carda, cardn, cvv, cardd, prod) {
    if(name !== "" && adress !== "" && email !== "" && cardh !== "" && cardn !== "" && cvv !== "" && cardd !== ""){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };

    xmlhttp.open("GET","add.php?q="+add +"&a="+name + "&b="+adress + "&c="+email + "&d="+cardh + "&e="+carda +"&f="+cardn +"&g="+cvv +"&h="+cardd + "&i="+prod,true);
    xmlhttp.send();
}
}
</script>
</head>
<body>

	
	<a href="/frontpage.php">
        	<header>
                	<h1>PhoneStore666</h1>
        	</header>
        </a>
	
	<button onclick="document.location='cart.php'">Cart</button>
        <button onclick="document.location='logout.php'">Logout</button>	
        
	<section>
                <article>
                        <h2> Insert your payment informastion.</h2>
			<?php
			$q = $_REQUEST["q"];
			$p = $_REQUEST["p"];
                        ?>
			<form action="/frontpage.php">
                                <label for="fname"> Name(First and last name):</label><br>
                                <input type="name" id="fname" name="fname" required="" maxlength="45" size="50" value=""><br>			

                                <label for="deliveryaddress"> Delivery address:</label><br>
                                <input type="name" id="deliveryaddress" name="deliveryaddress" maxlength="45" size="50" required="" value=""><br>

                                <label for="email"> Email: </label><br>
                                <input type="email" id="email" name="email" required="" maxlength="45" size="50" value=""><br>

                                <label for="cardholder"> Card holder:</label><br>
                                <input type="name" id="cardholder" name="cardholder" required="" maxlength="45" size="50" value=""><br>

                                <label for="cardaddress"> Billing address: </label><br>
                                <input type="name" id="cardaddress" name="cardaddress" required="" maxlength="45" size="50" value=""><br>

                                <label for ="cardnumber"> Card number </label><br>
                                <input typ="number" id="cardnumber" name="cardnumber" required="" maxlength="16" value="">

                                        <label for="csf"> Cfs: </label>
                                        <input typ="number" id="cvv" name="cvv" maxlength="3" required="" size="2" value=""><br>

                                <label for="date"> Experastiondate: </label><br>
                                <input type="date" id="carddate" name="carddate" required=""  min="2020-11-16" value=""><br>

				(make sure to check the informastion, there will not be another page after this) <br>
				<?php  if($q==1){ ?>
                                <input type ="submit" value="Submit" onclick="addValue(1, fname.value, deliveryaddress.value, email.value, cardholder.value, cardaddress. value, cardnumber.value, cvv.value, carddate.value, <?php echo $p ?> )">
				<?php }  
				if($q==2){
				echo " did it work";
				?>
				<input type ="submit" value="Submit" onclick="addValue(4, fname.value, deliveryaddress.value, email.value, cardholder.value, cardaddress. value, cardnumber.value, cvv.value, carddate.value, <?php echo $p ?> )">
				<?php
				}
				
				?>
		        </form>
                </article>
                <nav>
 	<h2> Product in checkout </h2>
<?php
$q = $_REQUEST["q"];
 $p = $_REQUEST["p"];
//Login credentials
$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";
$dbname2= "user";
//Gets parameter from url

$conn = new mysqli($servername, $username, $password, $dbname);
$car = 	new mysqli($servername, $username, $password, $dbname2);      

if($q==1){
	mysqli_close($car);
	
	mysqli_select_db($con,"ajax_demo");
        $sql="SELECT product_name,  cost, picture, disc FROM products WHERE Product_ID = '".$p."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
?>
<br>	
<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>
<br>
<b>Namn:</b> <?php echo $row["product_name"] ?>
<br>
<b>Price:</b> <?php echo $row["cost"] ?> kr
<br>
<?php
mysqli_close($con); 
}
if($q==2){
	$totalcost = 0;
	
	mysqli_select_db($car,"ajax_demo");
	$cont="SELECT Product_ID, quantity FROM cart where id='".$p."'";
        $cart = $car->query($cont);
	mysqli_select_db($conn,"ajax_demo");
        while($row = $cart->fetch_assoc()) {
		$usep = $row['Product_ID'];
		
		$amount = $row['quantity'];
        	mysqli_select_db($conn,"ajax_demo");
                $sql="SELECT Product_ID, product_name, cost, picture FROM products where Product_ID='".$usep."'";
                $result = $conn->query($sql);
		
		
                $rowB = $result->fetch_assoc();	
		$total += $rowB['cost'] * $row['quantity'];
		
		
		?>
			<br>
			<b>Namn:</b> <?php echo $rowB["product_name"] ?> 
			<br>
			<b> Amount:</b> <?php  echo $row['quantity'];  ?> <b>st</b>
			<br>
			<b>Price:</b> <?php echo $rowB["cost"] ?> kr
			<br>
		<?php
				
	}
	?>
	<br><br>
	<b>Total cost: </b> <?php echo $total ?> <b>Kr </b>
	<?php
	mysqli_close($con);
	mysqli_close($car);
}
?>

		</nav>
        </section>	
       <script>

</body>
</html>
