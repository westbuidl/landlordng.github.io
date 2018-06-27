<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Landlord|Home</title>
<meta name="author" content="Hyacinth Okeke (Mr West)" />
<meta name="description" content="Landlord your number1 logde and apartment renting platform in Nigeria" />
<meta name="google-site-verification" content="" />
<meta name="copyright" content="" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/landlord.png" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="engine1/style.css" />
<script type="text/javascript" src="engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->
<script type="text/javascript">
	function validate(){
		return confirm("Are you sure you want to delete this post?");
		
	}	
</script>
</head>




<body>


<div class="container">
<?php 

 require_once('includes/header.php');

?>
	

<div class="content">
   	<div id="slider">
			     
        <!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container1">
<div class="ws_images"><ul>
		<li><img src="data1/images/images (62).jpeg" alt="Convienient " title="Convienient " id="wows1_0"/></li>
		<li><a href=""><img src="data1/images/images (63).jpeg" alt="angular slider" title="Just signup and post" id="wows1_1"/></a></li>
		<li><img src="data1/images/images (64).jpeg" alt="Vacant apartments for Indivduals" title="Vacant apartments for Indivduals" id="wows1_2"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="Convienient"><span><img src="data1/tooltips/images (62).jpeg" alt="Convienient "/>1</span></a>
		<a href="#" title="Just signup and post"><span><img src="data1/tooltips/images (63).jpeg" alt="Just signup and post"/>2</span></a>
		<a href="#" title="Vacant apartments for Indivduals"><span><img src="data1/tooltips/images (64).jpeg" alt="Vacant apartments for Indivduals"/>3</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="#">jquery carousel</a>Mr West</div>
<div class="ws_shadow"></div>
</div>	
<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->
        	
         
           
      
  
 </div>
     	
   	  <div class="latestpost-wrap">
      <div id="h2"><h2> Available Vacancies </h2></div>
      
		

			
      			
         <?php

   require_once("db_login.php");
   //$user_id = $_GET["user_id"];
 
//create a connection to the database
	$conn = mysqli_connect($db_host,$db_username,$db_password,$db_name) or die (mysqli_error());
	
//to display data from the database on the index page
	$sql = "SELECT tbl_apartment.user_id,apartment_id, phone,user_name,image,type,location,rent,status,DATE_FORMAT(date,'%M %e,%Y') AS date FROM tbl_apartment inner join tbl_user_details on tbl_apartment.user_id = tbl_user_details.user_id ORDER BY apartment_id DESC";
	$result = mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($result)>0){
//output data for each row
	while($row=mysqli_fetch_assoc($result)){
		 
		echo "<div id='featured-images'>";
		echo '<div id="rent">';
			echo '₦'.$row['rent']." </div>";
		echo "<a href='uploads/".$row['image']."'><img src='uploads/".$row['image'].  "' width='330' height='250'></a>";
			
			
	echo "<div id='featured-desc'>";
		
			
			
			echo '<div id="type-box">';
		echo '<span class="type"></span>'.$row['type']."<br>";
			echo'</div>';
		
		echo '<div id="address-box">';
		echo '<span class="address"></span>'.$row['location']."<br>";
		echo'</div>';
		
		echo '<div id="post-box">';
		echo '<span class="user"></span>' .$row['user_name'] ."<br>";
		echo'</div>';
		echo '<div id="phone-box">';
		echo '<span class="phone"></span>' .$row['phone'] . "<br>";
		echo'</div>';
		echo '<div id="date-box">';
		echo '<b style="color:black">Date Posted:</b>'.$row['date'] . "<br>";
		echo '</div>';
		echo '<div id="status-box">';
		echo '<b style="color:black">Status:</b>' .$row['status'];
		echo'</div>';
		//echo '<b style="color:black">Status:</b>' .$row['apartment_id'];
		//echo $_SESSION['email'];
		 
		$apartment_id = $row['apartment_id'];
		$img_title= $row['image'];
		if(isset($_SESSION['user_id']))  {
		if ($row['user_id'] == ($_SESSION['user_id'] )){
			echo '<div id="action-box">';
		echo '<form  action="." enctype="multipart/form-data" method="post"  name="delete">';
		echo '<input type="hidden" name="apartment_id" id="apartment_id" value="'.$apartment_id.'" >';
		echo '<input type="hidden" name="img_title" id="img_title" value="'.$img_title.'" >';
        echo '<input type="submit" name="delete"  onclick="return validate()" id="delete-btn" value="Delete" />';
        echo'</form>';
		
		echo '<form  action="edit.php" enctype="multipart/form-data" method="post"  name="edit">';
		echo '<input type="hidden" name="apartment_id" id="apartment_id" value="'.$apartment_id.'" >';
		
        echo '<input type="submit" name="edit"   id="edit-btn" value="Edit" />';
        echo'</form>';
		echo '</div>';
		}
		// delete post function
		if(isset($_POST['delete'])){
			$img_title = $_POST['img_title'];
			$apartment_id = $_POST['apartment_id'];
			
 	
 	$sql= "DELETE FROM tbl_apartment WHERE apartment_id = $apartment_id "; 
 	mysqli_select_db('landlordapp_db');
	
	if (mysqli_query($conn, $sql)) {
    	
    	//unlink("$target_file");
		unlink("uploads/$img_title");
	//echo "Record deleted successfully" ;
	echo '<script>alert("Post deleted successfully");</script>' ;
	
	//header ('refresh:1; welcome.php');
	echo '<meta http-equiv="refresh" content="1; URL=">';
	} else {
    
	echo '<script>alert("Error Occured");</script>'  . mysqli_error($conn);
	
	}
		}// end of delete post function
		
			 
			
			
			}else{
			
		/*echo '<b style="color:black">Type:</b>'.''.$row['type']. "<br>";
		echo '<b style="color:black">Location:</b>'.$row['location'] . "<br>";
		echo '<b style="color:black">Rent Per Annum ₦</b>'.$row['rent']. "<br>";
		echo '<b style="color:black">Date Posted:</b>'.$row['date'] . "<br>";
		echo '<b style="color:black">Status:</b>' .$row['status'] ."<br>";
		echo "<b style='color:red'><a href='signup.php'>Signup</a> or <a href='login.php'>Login </a>to view contact details</b>";
			*/}
			
			
			
			
		echo '</div>';
		echo '</div>';
		
		$_POST =array();
		}
	}
	mysqli_close($conn);
	
	echo '</div>';
     
   
   
   
   
   
   
   
   
   
   
   
  
 
 
  if (!isset($_SESSION['user_id'])){
	  echo '<div class="sidebar">'; 
   echo	'<h2><a href="signup.php">SignUp</a> or <a href="login.php">Login</a> to post photo and details of vacant apartments around you.</h2> ';
  
	echo'</div>';
  }

		
		echo '<div class="sidebar">';
	echo '<h4> Get vacant apartments in your logde featured on here in 3 simple steps:
		<ol type="i">
<li>Visit the landlord webpage.</li><br />
<li> Signup if your are a new user, so you can have access to the POST apartment page.</li><br />
<li> Login as an existing user with your email and password provided during the signup phase.</li></br>
		</ol>

And that is all, post your vacant apartments for the world to see.</br>

Thanks for using Landlord. </h4>';  echo'</div>';
	echo ' <div class="sidebar">
	<p> Follow LandLord on <a href="www.facebook.com/landlordnigeria" target="_blank" ><span class="social"><img src="images/glyphicons-social-31-facebook.png">
    <a href="#"><span class="social"><img src="images/glyphicons-social-32-twitter.png"></a></p>';
	
	
	
	echo'</div>';

   ?> 
     
  <!-- <div class="social-icons">
            	
                <li><a href="www.facebook.com/landlordng" target="_blank"><img src="images/facebook.png" alt="facebook" width="32" height="32" /></a>
               <li><a href="#"><img src="images/twitter.png" alt="twitter" width="32" height="32" /></a>
        </div> -->
              
     
    
 

 </div> 

<?php require_once('includes/footer.php')?>
   
  
  </div>
</body>
</html>
