<?php
$loggedUser = '<div class="loggedUser">
';
if ($_SESSION['logged']) {
   $loggedUser = $loggedUser . 'You are logged in as: ' . $_SESSION['username'];
}

$nav = '<nav>
<ul>
   <li><a href="../index.php">Home</a></li>
   <li><a href="../search.php">Search</a></li>';

if ($_SESSION['logged']){
   $nav = $nav . '<li><a href="../board.php">Bulletin Board</a></li>
   <li><a href="../post.php">Make a post</a></li>
   <li><a href="../edit-profile.php">Profile</a></li>
   <li><a href="../logout.php">Logout</a></li>';
} else {
   $nav = $nav . '<li><a href="../register.php">Register</a></li>
   <li><a href="../login.php">Login</a></li>';
}

$nav = $nav . '</ul>
</nav>
</div>';

$banner = $loggedUser . $nav;
?>
