<?php
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
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
  

 



    $query="insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
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
        <p class="logo">Food <b style="color: #06C167; ">Donate</b></p>
        
       <div class="input">
        <label for="foodname"  > Food Name:</label>
        <input type="text" id="foodname" name="foodname" required/>
        </div>
      
      
        <div class="radio">
        <label for="meal" >Meal type :</label> 
        <br><br>

        <input type="radio" name="meal" id="veg" value="veg" required/>
        <label for="veg" style="padding-right: 40px;">Veg</label>
        <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
        <label for="Non-veg">Non-veg</label>
    
        </div>
        <br>
        <div class="input">
        <label for="food">Select the Category:</label>
        <br><br>
        <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="raw-food">
            <label for="raw-food">
              <img src="img/raw-food.png" alt="raw-food" >
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="cooked-food"checked>
            <label for="cooked-food">
              <img src="img/cooked-food.png" alt="cooked-food" >
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="packed-food">
            <label for="packed-food">
              <img src="img/packed-food.png" alt="packed-food" >
            </label>
          </div>
          <br>
        <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
        <label for="quantity">Quantity:(number of person /kg)</label>
        <input type="text" id="quantity" name="quantity" required/>
        </div>
       <b><p style="text-align: center;">Contact Details</p></b>
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
      <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
        
      </div>
      </div>
        <div class="input">
        <label for="location"></label>
        <label for="district">District:</label>
<select id="district" name="district" style="padding:10px;">
  <option value="bagerhat">Bagerhat</option>
  <option value="bandarban">Bandarban</option>
  <option value="barguna">Barguna</option>
  <option value="barisal">Barisal</option>
  <option value="bhola">Bhola</option>
  <option value="bogra">Bogra</option>
  <option value="brahmanbaria">Brahmanbaria</option>
  <option value="chandpur">Chandpur</option>
  <option value="chapainawabganj">Chapainawabganj</option>
  <option value="chittagong">Chittagong</option>
  <option value="chuadanga">Chuadanga</option>
  <option value="comilla">Comilla</option>
  <option value="coxsbazar">Cox's Bazar</option>
  <option value="dhaka">Dhaka</option>
  <option value="dinajpur">Dinajpur</option>
  <option value="faridpur">Faridpur</option>
  <option value="feni">Feni</option>
  <option value="gaibandha">Gaibandha</option>
  <option value="gazipur">Gazipur</option>
  <option value="gopalganj">Gopalganj</option>
  <option value="habiganj">Habiganj</option>
  <option value="jamalpur">Jamalpur</option>
  <option value="jessore">Jessore</option>
  <option value="jhalokati">Jhalokati</option>
  <option value="jhenaidah">Jhenaidah</option>
  <option value="joypurhat">Joypurhat</option>
  <option value="khagrachhari">Khagrachhari</option>
  <option value="khulna">Khulna</option>
  <option value="kishoreganj">Kishoreganj</option>
  <option value="kurigram">Kurigram</option>
  <option value="kushtia">Kushtia</option>
  <option value="lakshmipur">Lakshmipur</option>
  <option value="lalmonirhat">Lalmonirhat</option>
  <option value="madaripur">Madaripur</option>
  <option value="magura">Magura</option>
  <option value="manikganj">Manikganj</option>
  <option value="meherpur">Meherpur</option>
  <option value="moulvibazar">Moulvibazar</option>
  <option value="munshiganj">Munshiganj</option>
  <option value="mymensingh">Mymensingh</option>
  <option value="naogaon">Naogaon</option>
  <option value="narail">Narail</option>
  <option value="narayanganj">Narayanganj</option>
  <option value="narsingdi">Narsingdi</option>
  <option value="natore">Natore</option>
  <option value="netrokona">Netrokona</option>
  <option value="nilphamari">Nilphamari</option>
  <option value="noakhali">Noakhali</option>
  <option value="norail">Norail</option>
  <option value="pabna">Pabna</option>
  <option value="panchagarh">Panchagarh</option>
  <option value="patuakhali">Patuakhali</option>
  <option value="pirojpur">Pirojpur</option>
  <option value="rajbari">Rajbari</option>
  <option value="rajshahi">Rajshahi</option>
  <option value="rangamati">Rangamati</option>
  <option value="rangpur">Rangpur</option>
  <option value="satkhira">Satkhira</option>
  <option value="shariatpur">Shariatpur</option>
  <option value="sherpur">Sherpur</option>
  <option value="sirajganj">Sirajganj</option>
  <option value="sunamganj">Sunamganj</option>
  <option value="sylhet">Sylhet</option>
  <option value="tangail">Tangail</option>
  <option value="thakurgaon">Thakurgaon</option>
</select>
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