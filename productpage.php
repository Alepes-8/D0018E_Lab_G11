<?php 
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
<title>Product Page</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
textarea {
  resize: none;
  width: 300px;
  height: 150px;
}
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

#signin textarea {
    resize: none;
}
nav
{
        -website-flex: 1;
        -ms-flex: 1;
        flex: 1;
        padding: 10px;
}

/* Style the content */
article
{
        -webkit-flex: 3;
        -ms-flex: 3;
        flex: 3;
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
 <button onclick="document.location='cart.php'">Cart</button>
 <button onclick="document.location='logout.php'">Logout</button> 
<section>
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


<?php	
		$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
		if ($conn->connect_error) {
                	die("Connection failed: " . $conn->connect_error);
		}

	mysqli_select_db($conn,"ajax_demo");
        $sqlgrade="SELECT grading FROM grading_commenting WHERE Product_ID = '".$q."'";
        $graderesult = $conn->query($sqlgrade);
        $total = 0;
	$amount = 0;
	while($rowG = $graderesult->fetch_assoc()){
		$total += $rowG['grading'];
		$amount += 1;
	}
	$overallgrade = $total / $amount;
	
	
	mysqli_select_db($conn,"ajax_demo");
        $sql="SELECT product_name,  cost, picture, disc FROM products WHERE Product_ID = '".$q."'";
        $result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$stock="SELECT stock FROM stock WHERE Product_ID = '".$q."'";
        $info = $conn->query($stock);
        $stok = $info->fetch_assoc();
	
	
?>
<h2> <?php echo $row["product_name"] ?></h2>
<img src= "<?php echo $row["picture"]; ?>" width="200" height="200"/>

<p>
<b>Price of product:</b> <?php echo $row["cost"] ?> kr <br>
<b>Amount of products left in stock:</b> <?php echo $stok["stock"] ?>  <br>
<b>Product rating:</b> <?php echo $overallgrade; ?> <br> 
<b>Description of product:</b> <br>

<textarea readonly>
<?php echo $row["disc"] ?>
</textarea>	

</p>
 <p><b>Comment</b></p>

                <form  action="javascript: window.location.href='frontpage.php?q='+<?php echo $q ?>">

                       Name: <input type="name" id="nickname" name="nickname" required="" value="" maxlength="14" required=""><br><br>

                        Grading:
                        <br>
                        Awful
                        <input type="radio" id="one" name="grading" value="1" required="">
                        <label for="one">1</label>
                        <input type="radio" id="two" name="grading" value="2" required="">
                        <label for="two">2</label>
                        <input type="radio" id="three" name="grading" value="3" required="">
                        <label for="three">3</label>
                        <input type="radio" id="four" name="grading" value="4" required="">
                        <label for="four">4</label>
                        <input type="radio" id="five" name="grading" value="5" required="">
                        <label for="five">5</label>
                       
			 Amazing
                        <br><br>
                        Your comment(max 140 characters):
                        <div style = "position:relative; left:10px; top:2px;">
                        <textarea id="myTextarea" rows="4" cols="50" name="comment" form="usrform" maxlength="140" value=""></textarea>
                        </div>
					
			<button id="<?php echo $q ?>" onclick = "addgrade( 3, this.id, nickname.value, grading.value) ">Submit</button>
			
                </form>
	
                
 <?php mysqli_close($conn); ?>
</article>
<nav>
	
 <?php
				
				$product = $_REQUEST["q"];
                                $servername = "localhost";
                                $username = "root";
                                $password = "d0018eServer!";
                                $dbname = "store";

                               

                                $conn = new mysqli($servername, $username, $password, $dbname);
                                if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                }

                                mysqli_select_db($conn,"ajax_demo");
                                $sql="SELECT name, grading, comment FROM grading_commenting where Product_ID ='".$product."'";
                                $result = $conn->query($sql);
				
				?> <h2> Comments about the product </h2><?php
                                while($row = $result->fetch_assoc()) {
                                        echo  $row["name"].  "<br>";
                                        ?>
                                        
                                                <div>
							<b> Grading: </b> <?php echo $row["grading"]?><br>
							<?php
							 if($row["comment"] != NULL){
								?>
								<b> Comment:</b> <?php echo $row["comment"]?><br>		
								<?php
							}                                                     
                                                	?>
						<div>
                                        <?php
				
                                        echo "<br><br>";
                                }
				
                                mysqli_close($conn);
?>


</nav>
</section>

<footer>
	Contact Alex, Johan, or Oliver for any further questions
</footer>
	<script>
     	

	function addgrade( part, pid, name, grad) {
	   
	  if(name !== "" && grad !== ""){ 
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	      if (this.readyState == 4 && this.status == 200) {
	        document.getElementById("txtHint").innerHTML = this.responseText;
	      }
	    };
	   
	    xmlhttp.open("GET","add.php?q="+part +"&a="+pid + "&b="+name + "&c="+grad + "&d=" + document.getElementById("myTextarea").value,true);
	    xmlhttp.send();
	}
	}
        </script>
</body>
</html>
