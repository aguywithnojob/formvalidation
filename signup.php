<?php
	$conn = mysqli_connect("localhost","root","","today");
	if(mysqli_connect_errno())
	{
		echo "FAILED TO CONNECT TO MYSQL:".mysqli_connect_errno();
	}

?>

<?php 
		$nameErr=$emailErr=$cnameErr=$numberErr=$fileErr='';
		
		//form validation code

		if($_SERVER['REQUEST_METHOD']=="POST"){

			
		$name=$_POST['name'];
		$email=$_POST['email'];
		$cname=$_POST['cname'];
		$number=$_POST['number'];
		$filename=$_FILES['file']['name'];
		$file_tmp=$_FILES['file']['tmp_name'];
		$file_type=strtolower(pathinfo($filename,PATHINFO_EXTENSION));

		if(empty($name)){
			$nameErr="Name Required";
		}
		else if(empty($email)){
			$emailErr="Email Required";
		}	
		else if(empty($cname)){
			$cnameErr="Company Name Required";
		}	
		else if(empty($number)){
			$numberErr="Number Required";
		}	
		
		else{
				$name=test_input($name);
				$email=test_input($email);
				$cname=test_input($cname);
				if(!preg_match("/^[a-zA-Z ]*$/", $name)){
					$nameErr="only Letters and alphabets are required.";
				}
				else if(!filter_var($email,FILTER_VALIDATE_EMAIL) || preg_match("/^[a-zA-Z0-9]+.@gmail+.com$/", $email)|| preg_match("/^[a-zA-Z0-9]+.@yahoo+.com$/", $email)){
				$emailErr="Invalid email Format";
			}
			else if(!preg_match("/^[a-zA-Z ]*$/", $cname)){
				$cnameErr="Only Letters and alphabets are required.";
			}

			else if(strlen($number)!= 10){
			$numberErr="Number should be 10 digits";
				}

			else if($file_type!="pdf"){
				$fileErr="Only Pdf format";
			}
			else{
				$filename=$name.time().$filename;
				move_uploaded_file($file_tmp, "pdf/$filename");
					$sql="INSERT INTO today (name,email,company_name,contact_number,file) values ('".$name."','".$email."','".$cname."','".$number."','".$filename."')";
					$insert=mysqli_query($conn,$sql);
					if($insert){
						echo"<script>window.alert('successfully added to database');</script>";
						echo"<script>window.open('index.php','_self')</script>";
					}
		
		
			} 
		}

		
		}
		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}


		// Inserting data into database

	
	
	

?>

<!DOCTYPE html>
<html>
<head>
	<title>signup</title>

	
	<style>
		
		.error{
			color: red;
			font-weight: 200;
		}
		body {
 font-family:'Lucida Casual', 'Comic Sans MS';
 		background-image: url("background.jpg"); 
 		background-repeat: no-repeat;
 		background-size: 100%;

 	}

	input[type='submit']{
		font-weight: 200;
		color: #E0FFFF;

		font-size: 25px;
		width: 24% !important;
		background: #008B8B	;
		border:1px #008B8B solid; 
	}
	input[type='submit']:hover{
	
		background: #20B2AA;
		color: #E0FFFF;
	}
	.box{
		text-align: left; 
		margin-top:5% !important; 
		border: 1px solid white;
		 background:rgba(0,0,0,0.1);
 
		 padding-top: 20px; 
		 padding-bottom:20px; 
		
		 margin:0 auto;
		 width: 400px;
	}

	input[type='text']{
		
		
		font-size: 25px;

	}
	input[type='file']{
		font-family: "Georgia", serif; 
		font-size: 15px;
		color: cyan;

	}
	</style>
	
</head>
<body>
	<div class="box" style="">
			<h2 style="color: white; text-align:center;" >Signup Here</h2>
		<form  style="text-align: center;"  action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
		<input type="text" id="name" name="name" placeholder="Enter Name.."><br>
		<span class="error"> <?php echo $nameErr;?></span>
		<br><br>
		<input type="text" id="email" name="email" placeholder="Enter email" ><br>
		<span class="error"> <?php echo $emailErr;?></span>
		<br><br>
		<input type="text" id="cname" name="cname" placeholder="Enter Company Name" ><br>
		<span class="error"> <?php echo $cnameErr;?></span>
		<br><br>
		<input type="text" id="number" name="number" placeholder="Enter Contact number" ><br>
		<span class="error"> <?php echo $numberErr;?></span>
		<br><br>
		<input type="file" name="file"><br>
		<span class="error"> <?php echo $fileErr;?></span>		
<br><br>
  <input type="submit" name="submit" value="submit">
	</form>

	</div>

</body>
</html>

