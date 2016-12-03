<?php // Page the user is taken to to post a messeage on the bulletin board.
      // Maybe this should be included in the bulletin board page itself.
      // Still needs to be styled and change the tables for it to work correctly with the group db.
session_start();
if (!isset($_SESSION['logged'])) {  $_SESSION['logged'] = False;  }
if (!$_SESSION['logged']) {
   echo "You don't have permission to view this page.";
   exit;
} else {
   $username = $_SESSION['username'];
}

require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if (isset($_POST['title']) && isset($_POST['message'])) {
   $title = $_POST['title'];
   $message = $_POST['message'];
   $query = "INSERT INTO board(owner, date, title, message)
      VALUES('$username', NOW(), '$title', '$message')";
   $insert = $conn->query($query);
   if(!$insert) die ($conn->error);
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
      <li><a href="index.php">Home</a></li>
      <li><a href="#">Search</a></li>
      <li><a href="board.php">Bulletin Board</a></li>
      <li><a href="#">Make a post</a></li>
      <li><a href="register.php">Register/Profile</a></li>
      <li><a href="login.php">Login/Logout</a></li>
   </ul>
   </nav>
   <form class="message" action="post.php" method="post">
      <p>Title: <input type="text" name="title" value=""></p>
      <p>Message: </p>
      <textarea name="message" rows="8" cols="80"></textarea>
      <input type="submit" name="submit" value="Post">
   </form>
</body>
</html>
