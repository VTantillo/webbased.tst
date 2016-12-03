<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}
if (!$_SESSION['logged']) {
   echo "You don't have permission to view this page.";
   exit;
} else {
   $username = $_SESSION['username'];
}
require_once 'php/banner.php';
require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if (isset($_POST['title']) && isset($_POST['message'])) {
   $ownerId = $_SESSION['id'];
   $title = $_POST['title'];
   $message = $_POST['message'];

   $query = "INSERT INTO post(ownerId, owner, date, title, message)
      VALUES('$ownerId', '$username', NOW(), '$title', '$message')";
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
   <div class="banner">
      <?php echo $banner; ?>
   </div>
   <form class="register" action="post.php" method="post">
      <p>Title: <input type="text" name="title" value=""></p>
      <p>Message: </p>
      <textarea name="message" rows="8" cols="80"></textarea>
      <input type="submit" name="submit" value="Post">
   </form>
</body>
</html>
