<?php //login.php
require_once("dblogin.php");
if (isset($_POST['username']) && isset($_POST['password'])){
	$username = fix_string($_POST['username']);
	$password = fix_string($_POST['password']);


$connection = mysql_connect($hn, $un, $pw, $db);
if(!$connection){
	die('Could not connect: '. mysql_error());
}
mysql_select_db($db, $connection);
$query  = "SELECT * FROM users WHERE username='$username'";
$result=mysql_query($query, $connection);
	if (!$result) die($connection->error);
	elseif (mysql_num_rows($result)>=1)
	{
		$row = mysql_fetch_array($result,MYSQLI_NUM);
		$salt = "#nd@1";
  		$hashed = hash('ripemd128', "$salt$username$password");
  		if ($hashed == $row[1]){

  			session_start();
  			$_SESSION['user_type'] = $value;

  			if($value == "user"){
  			echo "<!DOCTYPE html>\n<html><head><title>Login Successful</title>";
			echo "</head><body><h3>Hello, you are now logged in as $username</h3>Links:<br>
    			 <a href=mainpage.php>Home Page</a><br>
    			 <a href=user.php>User Page</a></body></html>";
    			}

    		exit;
  		}
  		else echo "Could not log you in. Please try again";
	}
	else{
		echo "Could not log you in. Please try again";
	}
	mysql_close($connection);
}

echo <<<_END
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
      .signup {
        border:1px solid #999999;
        font:  normal 14px helvetica;
        color: #444444;
} </style>
  </head>
  <body>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Login Page</th>
      <form method="post" action="login.php" onsubmit="return validate(this)">
        <tr><td>Username</td>
          <td><input type="text" maxlength="16" name="username"></td></tr>
        <tr><td>Password</td>
          <td><input type="text" maxlength="12" name="password"></td></tr>
<tr><td colspan="2" align="center"><input type="submit"
          value="Log in"></td></tr>
      </form>
    </table>
  </body>
</html>
_END;

function fix_string($string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }

?>
