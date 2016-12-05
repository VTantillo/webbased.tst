<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}

$id = $_SESSION['id'];

require_once 'php/banner.php';

require_once 'php/login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

if(isset($_POST['submitted'])) {
   // Check if the user has already entered profile information
   $check = "SELECT * FROM profile WHERE userId = $id";
   $result = $conn->query($check);
   if (!$result) die ($conn->error);
   $num_rows = $result->num_rows;
   // If they have update the information
   if ($num_rows == 1) {
      $email = $_POST['email'];
      if (isset($_POST['pubEmail'])) {
         $pubEmail = $_POST['pubEmail'];
      } else {
         $pubEmail = '';
      }
      $phone = $_POST['phone'];
      if (isset($_POST['pubPhone'])) {
         $pubPhone = $_POST['pubPhone'];
      } else {
         $pubPhone = '';
      }
      $city = $_POST['city'];
      if (isset($_POST['pubCity'])) {
         $pubCity = $_POST['pubCity'];
      } else {
         $pubCity = '';
      }
      $state = $_POST['state'];
      if (isset($_POST['pubState'])) {
         $pubState = $_POST['pubState'];
      } else {
         $pubState = '';
      }
      $country = $_POST['country'];
      if (isset($_POST['pubCountry'])) {
         $pubCountry = $_POST['pubCountry'];
      } else {
         $pubCountry = '';
      }
      $bio = $_POST['bio'];
      if (isset($_POST['pubBio'])) {
         $pubBio = $_POST['pubBio'];
      } else {
         $pubBio = '';
      }

      $update = "UPDATE profile SET email = '$email', pubEmail = '$pubEmail',
      phone = '$phone', pubPhone = '$pubPhone', city = '$city', pubCity = '$pubCity',
      state = '$state', pubState = '$pubState', country = '$country', pubCountry = '$pubCountry',
      bio = '$bio', pubBio = '$pubBio' WHERE userId = $id";

      $result = $conn->query($update);
      if (!$result) die ($conn->error);
      // Else they haven't make a new profile for them.
   } elseif ($num_rows == 0) {
      $email = $_POST['email'];
      if (isset($_POST['pubEmail'])) {
         $pubEmail = $_POST['pubEmail'];
      } else {
         $pubEmail = '';
      }
      $phone = $_POST['phone'];
      if (isset($_POST['pubPhone'])) {
         $pubPhone = $_POST['pubPhone'];
      } else {
         $pubPhone = '';
      }
      $city = $_POST['city'];
      if (isset($_POST['pubCity'])) {
         $pubCity = $_POST['pubCity'];
      } else {
         $pubCity = '';
      }
      $state = $_POST['state'];
      if (isset($_POST['pubState'])) {
         $pubState = $_POST['pubState'];
      } else {
         $pubState = '';
      }
      $country = $_POST['country'];
      if (isset($_POST['pubCountry'])) {
         $pubCountry = $_POST['pubCountry'];
      } else {
         $pubCountry = '';
      }
      $bio = $_POST['bio'];
      if (isset($_POST['pubBio'])) {
         $pubBio = $_POST['pubBio'];
      } else {
         $pubBio = '';
      }

      $create = "INSERT INTO profile VALUES ($id, '$email', '$pubEmail', '$phone', '$pubPhone',
         '$city', '$pubCity', '$state', '$pubState', '$country', '$pubCountry', '$bio', '$pubBio')";

      $result = $conn->query($create);
      if (!$result) die ($conn->error);
   }
} else {
   $check = "SELECT * FROM profile WHERE userId = $id";
   $result = $conn->query($check);
   if (!$result) die ($conn->error);
   $num_rows = $result->num_rows;
   $row = $result->fetch_array(MYSQLI_ASSOC);
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

   // If they dont have an account put empty strings;
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
}

$form = '<form class="edit" action="/edit-profile.php" method="post">
   <input type="hidden" name="submitted" value="">
   <p>E-mail: <input type="text" name="email" value="' . $email . '">
   <label><input type="checkbox" name="pubEmail" value="checked" ' . $pubEmail . '> Public</label></p>
   <p>Phone: <input type="text" name="phone" value="' . $phone . '">
   <label><input type="checkbox" name="pubPhone" value="checked" ' . $pubPhone . '> Public</label></p>
   <p>City: <input type="text" name="city" value="' . $city . '">
   <label><input type="checkbox" name="pubCity" value="checked" ' . $pubCity . '> Public</label></p>
   <p>State: <input type="text" name="state" value="' . $state . '">
   <label><input type="checkbox" name="pubState" value="checked" ' . $pubState . '> Public</label></p>
   <p>Country: <input type="text" name="country" value="' . $country . '">
   <label><input type="checkbox" name="pubCountry" value="checked" ' . $pubCountry . '> Public</label></p>
   <p>Bio: <label><input type="checkbox" name="pubBio" value="checked" ' . $pubBio . '> Public</label></p>
   <textarea name="bio" maxlength="300" rows="8" cols="80">' . $bio . '</textarea>
   <input type="submit" name="submit" onclick="submit(this)" value="Submit Changes">
</form>';

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
   <div class="form">
      <?php
      echo $form;
      ?>
   </div>
</body>
</html>
