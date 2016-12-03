<?php  // Main page of the website. VT
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = False;
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
   <nav>
   <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Search</a></li>
      <li><a href="board.php">Bulletin Board</a></li>
      <li><a href="post.php">Make a post</a></li>
      <li><a href="register.php">Register/Profile</a></li>
      <li><a href="login.php">Login/Logout</a></li>
   </ul>
   </nav>
</body>
</html>
