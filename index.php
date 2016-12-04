<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}
require_once 'php/banner.php';

require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

$list = 'SELECT * FROM csdegree';

$result = $conn->query($list);
if(!$result) die ($conn->error);

$query = "SELECT id FROM user ORDER BY id";

$registered = $conn->query($query);
if(!$registered) die ($conn->error);

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
   <div class="filter-options">
      <form class="search" action="index.php" method="post">
         <input type="text" name="name" value="">
         <input type="submit" name="search" value="Search">
      </form>
      <form class="sort" action="index.php" method="post">
         <p>Sort by: </p>
         <p>Academic Year: <input type="radio" name="year" value="AcademicYear"></p>
         <p>First Name: <input type="radio" name="fname" value="FirstName"></p>
         <p>Last Name: <input type="radio" name="lname" value="LastName"></p>
         <p>Major: <input type="radio" name="major" value="Major"></p>
         <p>Level Code: <input type="radio" name="levelCode" value="Level Code"></p>
         <p>Degree: <input type="radio" name="degree" value="Degree"></p>
         <input type="submit" name="sort" value="Sort">
      </form>
      <form class="filter" action="index.php" method="post">
         <input type="submit" name="filter" value="Filter">
      </form>
   </div>
   <div class="list">
      List of all the graduates in the database.
      <div class="headers">
      <ul>
         <li>Id</li>
         <li>Academic Year</li>
         <li>First Name</li>
         <li>Last Name</li>
         <li>Major</li>
         <li>Level code</li>
         <li>Degree</li>
      </ul>
      </div>
      <?php
      $next = 0;
      $rows = $result->num_rows;
      $registered->data_seek($next);
      $nextUser = $registered->fetch_array(MYSQLI_ASSOC);

      for($i = 0; $i < $rows; $i++) {
         $result->data_seek($i);
         $row = $result->fetch_array(MYSQLI_ASSOC);
         echo '<div class="entry">
         <ul>';
         echo '<li>' . $row['id'] . '</li>';
         echo '<li>' . $row['AcademicYear'] . '</li>';
         echo '<li>' . $row['FirstName'] . '</li>';
         echo '<li>' . $row['LastName'] . '</li>';
         echo '<li>' . $row['Major'] . '</li>';
         echo '<li>' . $row['LevelCode'] . '</li>';
         echo '<li>' . $row['Degree'] . '</li>';
         if ($row['id'] == $nextUser['id']) {
            echo '<li><a href="/profile.php?id=' . $row['id'] . '">View Profile</a></li>';
            $next++;
            $registered->data_seek($next);
            $nextUser = $registered->fetch_array(MYSQLI_ASSOC);
         }
         echo "</ul>
         </div> \n";
      }
       ?>
   </div>

</body>
</html>
