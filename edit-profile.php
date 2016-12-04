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
      $phone = $_POST['phone'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $country = $_POST['country'];
      $bio = $_POST['bio'];

      $update = "UPDATE profile SET email = '$email', phone = '$phone', city = '$city',
      state = '$state', country = '$country', bio = '$bio'
      WHERE id = $id";
      // Else they haven't make a new profile for them.
   } elseif ($num_rows == 0) {
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $country = $_POST['country'];
      $bio = $_POST['bio'];

      $create = "INSERT INTO profile VALUES ($id, '$email', '$phone', '$city', '$state', '$country',
         '$bio')";

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
      $phone = $row['phone'];
      $city = $row['city'];
      $state = $row['state'];
      $country = $row['country'];
      $bio = $row['bio'];

   // If they dont have an account don't put empty strings;
   } elseif ($num_rows == 0) {
      $email = '';
      $phone = '';
      $city = '';
      $state = '';
      $country = '';
      $bio = '';
   }
}

$form = '<form class="edit" action="/edit-profile.php" method="post">
   <input type="hidden" name="submitted" value="">
   <p>E-mail: <input type="text" name="email" value="' . $email . '"></p>
   <p>Phone: <input type="text" name="phone" value="' . $phone . '"></p>
   <p>City: <input type="text" name="city" value="' . $city . '"></p>
   <p>State: <input type="text" name="state" value="' . $state . '"></p>
   <p>Country: <input type="text" name="country" value="' . $country . '"></p>
   <p>Bio:</p>
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
      <?php echo $form; ?>
   </div>
</body>
</html>
