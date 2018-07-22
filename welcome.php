<?php
	session_start();
	if(!isset($_SESSION['name'])){
		echo"<script>window.open('index.php','_self');</script>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>welcome page</title>
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
		color: blue;
		font-size: 25px;
		background: #E0FFFF	;
		border:1px #008B8B solid; 
	}
	input[type='submit']:hover{
	
		background: #008B8B;
		color: #E0FFFF;
	}
	.box{
		text-align: left; 
		margin-top:10% !important; 
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
	<div>
		<h2 style="text-align: center; color: white">Welcome <i style="color:yellow"><?php echo $_SESSION['name'];?></i> you are successfully loggedin</h2>

		<a style="color:white; font-size:20px; margin-left: 47%;" href="logout.php">Logout</a>
	
	</div>
</body>
</html>