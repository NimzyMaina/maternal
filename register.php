<!DOCTYPE html>
<html>
<head>
	<title>REGISTER</title>
</head>
<body>
<p><a href="login.php">login</a> <a href="register.php">register</a></p>
<h1>REGISTER</h1>
    <form action="" method="POST">
    USERNAME:<input type="text" name="user"><br/>
    PASSWORD:<input type="password" name="pass"><br/>
    <input type="submit" value="login" name="submit"/>
    </form>
<?php
if(isset($_POST["submit"])){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	$con=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db('maternal') or die ("cannot select DB");

$query=mysql_query("SELECT* FROM login where username='".$user."' AND password='".$pass."'");
	$numrows=mysql_num_rows($query);
<<<<<<< HEAD
	if ($numrows==0)
	{ 
	$sql="INSERT INTO login (username,password) VALUES ('$user', '$pass')";
=======
	if ($numrows==0) 
	{
        $sql="INSERT INTO login (username,password) VALUES ('$user', '$pass')";
>>>>>>> 07b43f1de347cb0b341b73904dd44e5ad81ba42e
	$result=mysql_query($sql);
	if($result){
		echo "account successfully created";
	} else{
		echo "failure";
	}
}
else{
	echo "that username already exists";
}
}
?>
</body>
</html>
