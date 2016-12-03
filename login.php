<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}

require_once 'php/banner.php';
require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];

   $salt = 'TT@_@:*:3';
   // Check if the username already exists in the database.
   $query = "SELECT * FROM user WHERE username = '$username'";
   $result = $conn->query($query);
   if (!$result) die ($conn->error);

   // If the user is in the database, check their password.
   if ($result->num_rows == 1) {
      $result = $result->fetch_array(MYSQLI_ASSOC);
      $enteredPassword = $result['password'];
      $hash = hash('ripemd128', "$username$password$salt");
      echo $hash . "<br>";
      echo $enteredPassword . "<br>";
      if ($hash == $enteredPassword) {
         $_SESSION['logged'] = True;
         $_SESSION['id'] = $result['id'];
         $_SESSION['username'] = $username;
         header("Location: index.php");
      } else {
         echo "Incorrect password";
      }
   } else {
      echo "There is not a user with that name.";
   }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>CS Alumni</title>
</head>
<body>
   <div class="banner">
      <?php echo $banner; ?>
   </div>
   <form class="login" action="login.php" method="post">
      <p>Username: <input type="text" name="username" value=""></p>
      <p>Password: <input type="password" name="password" value=""></p>
      <input type="submit" name="submit" value="Login">
   </form>
</body>
</html>
