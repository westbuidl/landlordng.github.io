<?php
	   
	   //to check if file was sent
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	    
	    
	    
	require_once("includes/db.php");
    
    $i =0; //variable for indexing uploaded images
	$image = $listing_type =$location = $price= "";
    $target_dir = "uploads/";// declaring path where images are stored
    $target_file= $target_dir.basename($_FILES["files"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);  	
	$uploadOk = 1;

    
	


	 if(isset($_POST['upload'])){
	//get all the submitted data from the form
	 $image = $_FILES["files"]["name"];
	 $tmpname = $_FILES["files"]["tmp_name"];
	 $listing_type = $_POST["listing_type"];
	 $location = $_POST["location"];
	 $price = $_POST["price"];
	 $offer_type = $_POST["offer_type"];
	 $description =$_POST["description"];
	 $bathrooms =$_POST["baths"];
	 $bedrooms =$_POST["bedrooms"];
     $measurement =$_POST["measurement"];
     $username =$_POST["user_name"];
     $email = $_POST["email"];
     $phone = $_POST["phone"];
	 //$duration =$_POST["duration"];
	 //$document =$_POST["document"];
	 

	for($i=0; $i<=count($tmpname)-1; $i++){
		$name =addslashes($image[$i]); 
		$tmp=addslashes(file_get_contents($tmpname[$i]));
	 //$date = $_POST["date('D M Y')"];
	
	 //the path to store the uploaded image
	// $target_file = $target_dir.basename($_FILES["image"]["name"]);
	 
	 //when 
	// Check if file already exists
	if (file_exists($target_file)) {
		
		
		
		echo '<i style="color:red"> image already exists </i>';

    //echo '<i style="color:red">Sorry, image already exists.</i>';
		
	$uploadOk = 0;
	}
    //to restrict the size of image to be uploaded
	if ($_FILES["files"]["size"]  >  50000000) {
		echo '<i style="color:red"> file too large </i>';
    
    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" && $imageFileType !="JPG"  && $imageFileType !="JPEG"  && $imageFileType !="PNG" ) {
		echo '<i style="color:red"> Only pictures allowed for upload </i>';
		
    $uploadOk = 0;
	}
	
	//to validate the listing type input
	if (empty($_POST['listing_type'])) {
		echo 'Enter an apartment type';
		$uploadOk = 0;
	}else {
		$listing_type = trim($_POST['listing_type']);
	}
	
	//to validate the input of location
	if (empty($_POST['location'])) {
		echo 'Please enter a location';
		$uploadOk = 0;
	}else{
		$location = trim($_POST['location']);
	}
	
	//to validate the rent input
	if (is_numeric($_POST['price'])){
		echo '<i style="color:red">Please enter a numeric value for rent</i>';
		$uploadOk = 0;
	}else{ 
	
	if ($uploadOk == 0) {

		echo '<i style="color:red"> upload failed try again </i>';

		
	}else{
	 //establish a connection to the database
	 
	
	 $conn = mysqli_connect($db_host,$db_username,$db_password,$db_name) or die (mysqli_error());
	
	
	 //to insert into the database
	 $sql = "INSERT INTO tbl_property(property_id,image,listing_type,offer_type,bathrooms,bedrooms,property_price,measurement,property_location,user_name,phone,email,property_description,date,status) VALUES ('null','$image', '$listing_type','$offer_type','$bathrooms','$bedrooms','$price','$measurement','$location','$username','$phone','$email','$description', NOW(),'Available')";
	
	 //stores the submitted data into the database 
	 $result = mysqli_query($conn,$sql);
	  
	  //to check if query executed
	  if (!$result) {
               // die (mysqli_error());       
        echo '<i style="color:red"> Error occured try again</i>';
		  
	  }else{
	
	
	//to move the uploaded file into the images folder
	if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {
		echo '<script>alert("Property Submission Successful") </script>' ;
                                        

         echo '<meta http-equiv="refresh" content="1; URL= index.php">';
	}else{ 
		echo '<i style="color:red"> failed uploading <//>';
		
					}
				}
 			}
 			}
	 
		}
    }
	}
	?>