<?php //registration.php
require_once("dblogin.php");
if (isset($_POST['username'])){
	$username = fix_string($_POST['username']);
	$password = fix_string($_POST['password']);
	$connection = mysql_connect($hn, $un, $pw, $db);
	if(!$connection){
		die('Could not connect: '. mysql_error());
	}
	mysql_select_db($db, $connection);
	$query = "SELECT * FROM users WHERE username = '".$username."'";
	$result=mysql_query($query, $connection);
	if(mysql_num_rows($result)>=1)
       {
        $taken = 1;
       }

	$query = "SELECT * FROM users WHERE lastname = '".$lastname."' AND firstname = '".$firstname."'";
	$result=mysql_query($query, $connection);
	if(mysql_num_rows($result)>=1)
	        {
	         $taken = 2;
	        }
				}
if (isset($_POST['lastname']) && isset($_POST['firstname'])){
	$lastname = fix_string($_POST['lastname']);
	$lastname = fix_string($_POST['firstname']);
	$connection = mysql_connect($hn, $un, $pw);
	if(!$connection){
		die('Could not connect: '. mysql_error());
	}
	mysql_select_db("wb_longpre", $connection);
	$query = "SELECT * FROM csdegrees WHERE lastname = '".$lastname."' AND firstname = '".$firstname."'";
	$result=mysql_query($query, $connection);
	if(mysql_num_rows($result)>=1)
	{
		$found = 1;
	}
	else {
		echo "This person was not found";
	}

	if(!$taken){
		$row = mysql_fetch_assoc( $result );
		$id = $row['id'];
		$academicyear = $row['AcademicYear'];
		$term = $row['Term'];
		$lastname = $row['LastName'];
		$firstname = $row['FirstName'];
		$major = $row['Major'];
		$levelcode = $row['LevelCode'];
		$degree = $row['Degree'];
	}
}

if(!$taken && $found && isset($_POST['username']) && isset($_POST['password'])){
	$connection = mysql_connect($hn, $un, $pw);
	if(!$connection){
		die('Could not connect: '. mysql_error());
	}
	mysql_select_db($db, $connection);
	$salt = "#nd@1";
	$password = hash('ripemd128',"$salt$username$password");
	$query = "INSERT INTO users (id,AcademicYear,Term,LastName,FirstName,Major,LevelCode,Degree,username,password,public)
	VALUES ('$id','$academicyear','$term','$lastname','$firstname','$major','$levelcode','$degree','$username','$password','0')";
	$result=mysql_query($query, $connection);
	if($result){
	  header("Location: mainpage.php"); //redirect to mainpage
	}
	else {
	  echo 'Error: Not registered<br>';
	}
}

echo <<<_END
<!DOCTYPE html>
<html>
  <head>
    <title>Registration Form</title>
    <style>
      .signup {
        border:1px solid #999999;
        font:  normal 14px helvetica;
        color: #444444;
} </style>
    <script>
      function validate(form)
      {
        fail = validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
				fail += validateName(form.firstname.value)
				fail += validateName(form.lastname.value)
        if   (fail == "")   return true
        else { alert(fail); return false }
      }
			function validateName(field){
				field == "" ? return "No Username was entered.\\n" : return ""
			}
      function validateUsername(field)
	  {
  	  if (field == "") return "No Username was entered.\\n"
		else if (field.length < 5)
		  return "Usernames must be at least 5 characters.\\n"
	  else if (/[^a-zA-Z0-9_-]/.test(field))
		  return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\\n"
		return ""
	   }
	   function validatePassword(field)
	   {
  	   if (field == "") return "No Password was entered.\\n"
   	   else if (field.length < 6)
         return "Passwords must be at least 6 characters.\\n"
  	   else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
         !/[0-9]/.test(field))
    	 return "Passwords require one each of a-z, A-Z and 0-9.\\n"
  	   return ""
	   }
    </script>
  </head>
  <body>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Registration Form</th>
      <form method="post" action="registration.php" onsubmit="validate(this)">
        <tr><td>First name</td>
          <td><input type="text" maxlength="30" name="firstname"></td></tr>
        <tr><td>Last name</td>
          <td><input type="text" maxlength="30" name="lastname"></td></tr>
        <tr><td>Username</td>
          <td><input type="text" maxlength="30" name="username"></td></tr>
        <tr><td>Password</td>
          <td><input type="text" maxlength="30" name="password"></td></tr>
<tr><td colspan="2" align="center"><input type="submit"
          value="Signup"></td></tr>
      </form>
    </table>
  </body>
</html>
_END;

if($taken == 1){
	echo "Username is already taken";
}
if($taken == 2){
	echo "This person is already registered";
}

function fix_string($string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }
?>
