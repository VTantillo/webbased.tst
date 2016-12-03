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
require_once 'php/login.php';
require_once 'php/banner.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

$query = "SELECT * FROM post";
$posts = $conn->query($query);
if(!$posts) die ($conn->error);

$num_rows = $posts->num_rows;
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
   <h1>Bulletin Board: </h1>
   <?php
   for($i = 0; $i < $num_rows; $i++) {
      $posts->data_seek($i);
      $row = $posts->fetch_array(MYSQLI_ASSOC);
      echo "<h3>Title: " . $row['title'] . "</h3>";
      echo "<h4>Posted by: " . $row['owner'] . "</h4>";
      echo "<h4>Date posted: " . $row['date'] . "</h4>";
      echo "<h4>Message: </h4>";
      echo "<p>" . $row['message'] . "</p>";
   }
    ?>
</body>
</html>
