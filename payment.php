<!DOCTYPE html>
<html lang="swe">

<head>
<title> payment </title>
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
        font-family:;
        padding:10px;
        left:10px;
        top:40px;
}


article
{
        -website-flex: 3;
        -ms-flex: 3;
        flex: 3;
        padding: 10px;
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

function addValue(add, name, adress, email, cardh, carda, cardn, cvv, cardd) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };

    xmlhttp.open("GET","add.php?q="+add +"&a="+name + "&b="+adress + "&c="+email + "&d="+cardh + "&e="+carda +"&f="+cardn +"&g="+cvv +"&h="+cardd,true);
    xmlhttp.send();
}
</script>
</head>
<body>
        <a href="/frontpage.php">
        	<header>
                	<h1>PhoneStore</h1>
        	</header>
        </a>
        <section>
                <article>
                        <p> Har går inputen som registeras och hanteras som namn, email, payment information. Denna information ska sparas så att när man handlar något går denna information till butiken.
                        <form action="/frontpage.php">
                                <label for="fname"> Name(First and last name):</label><br>
                                <input type="name" id="fname" name="fname" required="" value=""><br>			

                                <label for="deliveryaddress"> Delivery address:</label><br>
                                <input type="name" id="deliveryaddress" name="deliveryaddress" required="" value=""><br>

                                <label for="email"> Email: </label><br>
                                <input type="email" id="email" name="email" required="" value=""><br>

                                <label for="cardholder"> Card holder:</label><br>
                                <input type="name" id="cardholder" name="cardholder" required="" value=""><br>

                                <label for="cardaddress"> Billing address: </label><br>
                                <input type="name" id="cardaddress" name="cardaddress" required="" value=""><br>

                                <label for ="cardnumber"> Card number </label><br>
                                <input type="number" id="cardnumber" name="cardnumber" required="" maxlength="16" value="">

                                        <label for="csf"> Cfs: </label>
                                        <input typ="number" id="cvv" name="cvv" maxlength="3" required="" value=""><br>

                                <label for="date"> Experastiondate: </label><br>
                                <input type="date" id="carddate" name="carddate" required=""  min="2020-11-16" value=""><br>

                                <input type ="submit" value="Submit" onclick="addValue(1, fname.value, deliveryaddress.value, email.value, cardholder.value, cardaddress. value, cardnumber.value, cvv.value, carddate.value)">
		        </form>
                </article>
                <nav>
                        Här kommer produkten, eller produkterna som ska handlas under detta tillfälle. Om det kommer från cart så hamnar det ju flera där, annars om det endast är en så hamnar endast den produkten där. Kanske för att göra det lättare för oss, skulle vi kunna lägga in två olika html filer. En av dessa filer hanterar payment för en produkt, medans den andra hanterar betalningen för cart.

<?php
$q = $_REQUEST["q"];
//Login credentials
$servername = "localhost";
$username = "root";
$password = "d0018eServer!";
$dbname = "store";

//Gets parameter from url

$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
                if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                }
        mysqli_select_db($con,"ajax_demo");
        $sql="SELECT product_name, stock, cost, picture, disc FROM products WHERE product_name = '".$q."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
?>
<br>	
<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>
<br>
Namn av produkt: <?php echo $row["product_name"] ?>
<br>
Pris av produkt: <?php echo $row["cost"] ?> kr
<br>


		</nav>
        </section>	
</body>
</html>
