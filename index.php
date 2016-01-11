<?php

require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
//load config
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

//requiring configs
$dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD','SITE_URL']);

//echo  $host = getenv('DB_HOST');
// echo get_domain();

/*$extras = array('#special_id','.special_class');
echo anchor('test.php','New Page','Custom Title Message!',$extras);*/

if($_POST){
	// get database connection
	include_once 'config/database.php';
	
	require 'classes/user.php';

	$user = new User($db);

	 $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    $result = $user->register();

    if($result){
    	$state = true;
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