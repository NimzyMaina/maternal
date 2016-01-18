<?php

require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

 // get database connection
    $db = new Database();


if($_POST){
	$user = new User($db->conn);

	 $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    $result = $user->register();

    if($result){
    	header("Location: homepage.php");
    }else{
    	$state = false;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<div>
<form action="index.php" method="post">
	USERNAME:<input type="text" name="username" placeholder="username"><br>
	PASSWORD:<input type="password" name="password"><br>
	<button name="submit" type="submit">Register</button>
	</form>
</div>
<?php if(isset($state)){
	if($state){
		echo 'User registered';
	}else{
		echo 'user not registered';
	}
	}?>
</body>
</html>