<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}
if (!isset($_SESSION['registration'])) {
   $_SESSION['registration'] = 1;
}

require_once 'php/banner.php';
require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if ($_SESSION['registration'] == 2) {
   $form = '<div class="step2">
      <p>Choose a username and password</p>
      <form class="username" action="register.php" onclick="validate(this)" method="post">
         <p>Username: </p>
         <input type="text" name="username" value="">
         <p>Password: </p>
         <input type="password" name="password" value="">
         <p>Confrim password</p>
         <input type="password" name="confrim" value="">
         <input type="submit" name="submit" value="Submit">
      </form>
   </div>';
}

if ($_SESSION['registration'] == 1) {
   $form = '<div class="step1">
      <p>Pleas enter your first and last name, and the the year of your most recent degree from
      UTEP </p>
      <form class="confirm" action="register.php" onclick="validate(this)" method="post">
         <p>First Name:</p><input type="text" name="FirstName" value="">
         <p>Last Name:</p><input type="text" name="LastName" value="">
         <p>Graduation Year: </p>
         <select class="gradYear" name="AcademicYear">
            <option value="1995-96">1995-96</option>
            <option value="1996-97">1996-97</option>
            <option value="1997-98">1997-98</option>
            <option value="1998-99">1998-99</option>
            <option value="1999-00">1999-00</option>
            <option value="2000-01">2000-01</option>
            <option value="2001-02">2001-02</option>
            <option value="2002-03">2002-03</option>
            <option value="2003-04">2003-04</option>
            <option value="2004-05">2004-05</option>
            <option value="2005-06">2005-06</option>
            <option value="2006-07">2006-07</option>
            <option value="2007-08">2007-08</option>
            <option value="2008-09">2008-09</option>
            <option value="2009-10">2009-10</option>
            <option value="2010-11">2010-11</option>
            <option value="2011-12">2011-12</option>
            <option value="2012-13">2012-13</option>
            <option value="2013-14">2013-14</option>
            <option value="2014-15">2014-15</option>
         </select>
         <p>Level: </p>
         <select class="level" name="LevelCode">
            <option value="UG">UG</option>
            <option value="GR">GR</option>
            <option value="DR">DR</option>
         </select>

         <input type="submit" name="submit" value="Submit">
      </form>
   </div>';
   $_SESSION['registration'] = 2;
}

if (isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['AcademicYear'])) {
   $fname = $_POST['FirstName'];
   $lname = $_POST['LastName'];
   $year = $_POST['AcademicYear'];

   $query = "SELECT * FROM csdegree WHERE FirstName = '$fname'AND LastName = '$lname' AND AcademicYear = '$year'";
   $result = $conn->query($query);
   if (!$result) die ($conn->error);

   $rows = $result->num_rows;

   if ($rows == 1) {
      $result = $result->fetch_array(MYSQLI_ASSOC);
      $_SESSION['id'] = $result['id'];
      $_SESSION['registration'] = 2;
   }
}

// Step 2 check username and password
if (isset($_POST['username']) && isset($_POST['password'])) {
   $id = $_SESSION['id'];
   $username = $_POST['username'];
   $password = $_POST['password'];

   $salt = 'TT@_@:*:3';
   // Check if the username already exists in the database.
   $query = "SELECT * FROM user WHERE username = '$username'";
   $result = $conn->query($query);
   if (!$result) die ($conn->error);

   // If the user is not in the database, register them.
   if ($result->num_rows == 0) {
      $hash = hash('ripemd128', "$username$password$salt");
      $query = "INSERT INTO user VALUES ($id, '$username', '$hash')";

      $insert = $conn->query($query);
      if (!$insert) die ($conn->error);

      // Redirect the user to their profile page to fill out additional information.
      $_SESSION['registration'] = 1;
      header('Location: index.php');
   } else {
      echo "User with that name already exists.";
   }
}

// Step 3 user enters additional profile information.
if (isset($_POST['userId']))
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <script src="js/validate.js" charset="utf-8"></script>
   <title>CS Alumni</title>
</head>
<body>
   <div class="banner">
      <?php echo $banner; ?>
   </div>
   <div class="content">
      <?php echo $form; ?>
   </div>
</body>
</html>
