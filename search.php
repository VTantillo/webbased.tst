<?php
session_start();
if (!isset($_SESSION['logged'])) {
   $_SESSION['logged'] = FALSE;
}

require_once 'php/banner.php';

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
   This is the search page.
</body>
</html>
