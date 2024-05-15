<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'demo');


if(isset($_POST['submit']))
{
    
    
    
    
    $q = "SELECT shirt_goal,pant_goal,sharee_goal,shirt_left,pant_left,sharee_left FROM cloth_storage";
    $r = mysqli_query($connection, $q);
    $shirt_goal;
    $pant_goal;
    $sharee_goal;
    $shirt_left;
    $pant_left;
    $sharee_left;
    // Check if the query was successful
    if ($r) {
        // Fetch a single row as an associative array
        $row = mysqli_fetch_assoc($r);
        
        // Extract the value of 'shirt_goal' from the fetched row
        $shirt_goal = $row['shirt_goal'];
        $pant_goal = $row['pant_goal'];
        $sharee_goal = $row['sharee_goal'];

        $shirt_lef = $row['shirt_lef'];
        $pant_left = $row['pant_left'];
        $sharee_left = $row['sharee_left;'];
        
        // Free result set
        mysqli_free_result($r);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($connection);
    }
    
    
   
    

    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
    
    if($category=="shirt"){
        $shirt_left= $shirt_goal-$quantity;
    }
    
  
    $query="insert into cloth_donation(email,category,phoneno,location,address,name,quantity) values('$emailid','$category','$phoneno','$district','$address','$name','$shirt_left')";
    
    $query_run= mysqli_query($connection, $query);
  
      require 'PHPMailer/Exception.php';
      require 'PHPMailer/PHPMailer.php';
      require 'PHPMailer/SMTP.php';
      $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'obito.uchiha1184@gmail.com';                     //SMTP username
    // $mail->Password   = 'mdgn iana dpuo bbns';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //sender
    $mail->setFrom('obito.uchiha1184@gmail.com', 'webProject'); //ae khane file ar directory
//receiver
    $mail->addAddress($emailid, 'amr website');     //Add a recipient
 

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Food Donation';
    $mail->Body    = 'I hate S.A.M  with every fiber of my being.I hope he dies a miserable death.I want him to go to the deepest and darkest boiler of hell.
    I hope  he dies slowly';
   
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
     
       
        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
        
    }

    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body style="    background-color: #06C167;">
    <div class="container">
        <div class="regformf" >
    <form action="" method="post">
        <p class="logo">কাপড়  <b style="color: #06C167; ">দান</b></p>
        
       <!-- <div class="input">
        <label for="foodname"  > Food Name:</label>
        <input type="text" id="foodname" name="foodname" required/>
        </div> -->
      
      
        <!-- <div class="radio">
        <label for="meal" >Meal type :</label> 
        <br><br>

        <input type="radio" name="meal" id="veg" value="veg" required/>
        <label for="veg" style="padding-right: 40px;">Veg</label>
        <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
        <label for="Non-veg">Non-veg</label>
    
        </div>
        <br> -->
        <div class="input">
        <label for="food">Select the Category:</label>
        <br><br>
        <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="shirt">
            <label for="raw-food">
              <img src="img/raw-food.png" alt="raw-food" >
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="lungi"checked>
            <label for="cooked-food">
              <img src="img/cooked-food.png" alt="cooked-food" >
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="Sharee">
            <label for="packed-food">
              <img src="img/packed-food.png" alt="packed-food" >
            </label>
          </div>
          <br>
        <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required/>
        
        </div>
       <b><p style="text-align: center;">Contact Details</p></b>
        
    <?php $q = "SELECT shirt_goal,pant_goal,sharee_goal,shirt_left,pant_left,sharee_left FROM cloth_storage";
    $r = mysqli_query($connection, $q);
    $shirt_goal;
    $pant_goal;
    $sharee_goal;
    $shirt_left;
    $pant_left;
    $sharee_left;
    
    // Check if the query was successful
    if ($r) {
        // Fetch a single row as an associative array
        $row = mysqli_fetch_assoc($r);
        
        // Extract the values from the fetched row
        $shirt_goal = $row['shirt_goal'];
        $pant_goal = $row['pant_goal'];
        $sharee_goal = $row['sharee_goal'];
    
        $shirt_left = $row['shirt_left'];
        $pant_left = $row['pant_left'];
        $sharee_left = $row['sharee_left'];
        // $category=$_POST['image-choice'];
        
        // Display the value inside a label tag
       
        // echo '<label for="sharee_left">' . '</label>';
        
        // Free result set
        mysqli_free_result($r);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($connection);
    }
    ?>
        <div class="input">
          <!-- <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
          </div> -->
      <div>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name"value="<?php echo"". $_SESSION['name'] ;?>" required/>
      </div>
      <div>
        <label for="phoneno" >PhoneNo:</label>
      <input type="text" id="phoneno" name="phoneno" maxlength="13"  required />
        
      </div>
      </div>
        <div class="input">
        <label for="location"></label>
        <label for="district">District:</label>
<select id="district" name="district" style="padding:10px;">
  <option value="chennai">Chennai</option>
  <option value="kancheepuram">Kancheepuram</option>
  <option value="thiruvallur">Thiruvallur</option>
  <option value="vellore">Vellore</option>
  <option value="tiruvannamalai">Tiruvannamalai</option>
  <option value="tiruvallur">Tiruvallur</option>
  <option value="tiruppur">Tiruppur</option>
  <option value="coimbatore">Coimbatore</option>
  <option value="erode">Erode</option>
  <option value="salem">Salem</option>
  <option value="namakkal">Namakkal</option>
  <option value="tiruchirappalli">Tiruchirappalli</option>
  <option value="thanjavur">Thanjavur</option>
  <option value="pudukkottai">Pudukkottai</option>
  <option value="karur">Karur</option>
  <option value="ariyalur">Ariyalur</option>
  <option value="perambalur">Perambalur</option>
  <option value="madurai" selected>Madurai</option>
  <option value="virudhunagar">Virudhunagar</option>
  <option value="dindigul">Dindigul</option>
  <option value="ramanathapuram">Ramanathapuram</option>
  <option value="sivaganga">Sivaganga</option>
  <option value="thoothukkudi">Thoothukkudi</option>
  <option value="tirunelveli">Tirunelveli</option>
  <option value="tiruppur">Tiruppur</option>
  <option value="tenkasi">Tenkasi</option>
  <option value="kanniyakumari">Kanniyakumari</option>
</select> 

        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address" required/><br>
        
      
       
       
        </div>
        <div class="btn">
            <button type="submit" name="submit"> submit</button>
     
        </div>
     </form>
     </div>
   </div>
     
    
</body>
</html>