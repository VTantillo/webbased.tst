<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}

require_once 'php/banner.php';

require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $profile = "SELECT * FROM profile WHERE userId = $id";
   $degree = "SELECT * FROM csdegree WHERE id = $id";

   $degree = $conn->query($degree);
   if (!$degree) die ($conn->error);

   $row = $degree->fetch_array(MYSQLI_ASSOC);

   $degreeInfo = '<li>' . $row['id'] . '</li>'
   . '<li>' . $row['AcademicYear'] . '</li>'
   . '<li>' . $row['FirstName'] . '</li>'
   . '<li>' . $row['LastName'] . '</li>'
   . '<li>' . $row['Major'] . '</li>'
   . '<li>' . $row['LevelCode'] . '</li>'
   . '<li>' . $row['Degree'] . '</li>';

   $profile = $conn->query($profile);
   if (!$profile) die ($conn->error);

   $num_rows = $profile->num_rows;
   $row = $profile->fetch_array(MYSQLI_ASSOC);
   // If they have insert the information into the table
   if ($num_rows == 1) {
      $email = $row['email'];
      $pubEmail = $row['pubEmail'];
      $phone = $row['phone'];
      $pubPhone = $row['pubPhone'];
      $city = $row['city'];
      $pubCity = $row['pubCity'];
      $state = $row['state'];
      $pubState = $row['pubState'];
      $country = $row['country'];
      $pubCountry = $row['pubCountry'];
      $bio = $row['bio'];
      $pubBio = $row['pubBio'];

   // If they dont have an account don't put empty strings;
   } elseif ($num_rows == 0) {
      $email = '';
      $pubEmail = '';
      $phone = '';
      $pubPhone = '';
      $city = '';
      $pubCity = '';
      $state = '';
      $pubState = '';
      $country = '';
      $pubCountry = '';
      $bio = '';
      $pubBio = '';
   }

   $profileInfo = '';

   if ($pubEmail == 'checked') {
      $profileInfo = $profileInfo . '<li><p>E-mail: ' . $email . '</p></li>';
   }
   if ($pubPhone == 'checked') {
      $profileInfo = $profileInfo . '<li><p>Phone: ' . $phone . '</p></li>';
   }
   if ($pubCity == 'checked') {
      $profileInfo = $profileInfo . '<li><p>City: ' . $city . '</p></li>';
   }
   if ($pubState == 'checked') {
      $profileInfo = $profileInfo . '<li><p>State: ' . $state . '</p></li>';
   }
   if ($pubContry == 'checked') {
      $profileInfo = $profileInfo . '<li><p>Country: ' . $country . '</p></li>';
   }
   if ($pubBio == 'checked') {
      $profileInfo = $profileInfo . '<li><p>Bio: ' . $bio . '</p></li>';
   }



} else {
   echo 'Please choose an alumni from the list on the home page to view their profile';
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
   <div class="profile">
      <ul>
         <?php echo $profileInfo; ?>
      </ul>
   </div>
   <div class="degree">
      <ul>
         <?php echo $degreeInfo; ?>
      </ul>
   </div>
</body>
</html>
