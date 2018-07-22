<?php

	$conn = mysqli_connect("localhost","root","","today");
	if(mysqli_connect_errno())
	{
		echo "FAILED TO CONNECT TO MYSQL:".mysqli_connect_errno();
	}

	session_start();
?>
<?php
	$eror='';
	if(isset($_POST['submit'])){
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$name=mysqli_real_escape_string($conn,$_POST['name']);
		$sql="SELECT name,email from today where name='$name' AND email='$email'";
		  $result=mysqli_query($conn,$sql);
		$check=mysqli_num_rows($result);

		if($check==0){
				
				$eror="Email or Name is incorrect...";
			}
			else{
				$_SESSION['name']=$name;
				echo "<script>window.open('welcome.php','_self');</script>";
			}
		

	}

?>
<!DOCTYPE html>


<html>
<head>
	<title>
		login
	</title>

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
		margin-top:10% !important; 
		
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

		.divide{
			width:3px;
			height: 300px;
			background-color: #008B8B;
			position: absolute;
			margin-left: 50%;
		}

	</style>
</head>
<body>
	
	<div class="box" style="">
	<h2 style="color: white; text-align:center;">Login Here</h2>
		<form style="text-align: center;" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<input type="text" name="name" placeholder="Enter name" required="required"><br><br>
			<input type="text" name="email" placeholder="Enter email" required="required"><br><br>

			<input type="submit" name="submit" value="login"><br><br>
			<span class="error"> <?php echo $eror;?></span>
			<a style="color:#008B8B;" href="signup.php">signup</a>


		</form>
	</div>
</body>
</html>


