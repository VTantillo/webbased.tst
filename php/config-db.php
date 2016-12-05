<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die ($conn->connect_error);

$createDegrees = 'CREATE TABLE csdegree(
   id int(11) AUTO_INCREMENT,
   AcademicYear VARCHAR(7),
   Term VARCHAR(6),
   LastName VARCHAR(30),
   FirstName VARCHAR(30),
   Major VARCHAR(30),
   LevelCode VARCHAR(30),
   Degree VARCHAR(30),
   PRIMARY KEY(id)
) Engine = InnoDB';

$createUsers = 'CREATE TABLE user(
   id int(11) PRIMARY KEY,
   username VARCHAR(32) UNIQUE,
   password CHAR(32),
   FOREIGN KEY(id) REFERENCES csdegree(id)
) Engine = InnoDB';

$createPosts = 'CREATE TABLE post(
   id INT(11) AUTO_INCREMENT,
   ownerId INT(11) UNIQUE,
   owner VARCHAR(32) UNIQUE,
   date DATE,
   title VARCHAR(30),
   message VARCHAR(300),
   PRIMARY KEY (id),
   FOREIGN KEY (ownerId) REFERENCES user(id),
   FOREIGN KEY (owner) REFERENCES user(username)
) Engine = InnoDB';

$createProfiles = 'CREATE TABLE profile(
   userId INT(11) PRIMARY KEY,
   email VARCHAR(50),
   pubEmail VARCHAR(7),
   phone VARCHAR(13),
   pubPhone VARCHAR(7),
   city VARCHAR(50),
   pubCity VARCHAR(7),
   state VARCHAR(30),
   pubState VARCHAR(7),
   country VARCHAR(20),
   pubCountry VARCHAR(7),
   bio VARCHAR(300),
   pubBio VARCHAR(7),
   FOREIGN KEY (userId) REFERENCES user(id)
) Engine = InnoDB';

$copyDegrees = 'INSERT INTO cs5339team2fa16.csdegree SELECT * FROM wb_longpre.csdegrees';

$dropDegree = 'DROP TABLE csdegree';
$dropUser = 'DROP TABLE user';
$dropPost = 'DROP TABLE post';
$dropProfile = 'DROP TABLE profile';

$drop = $conn->query($dropProfile);
if (!$drop) die ($conn->error);

$drop = $conn->query($dropPost);
if (!$drop) die ($conn->error);

$drop = $conn->query($dropUser);
if (!$drop) die ($conn->error);

$drop = $conn->query($dropDegree);
if (!$drop) die ($conn->error);

$create = $conn->query($createDegrees);
if (!$create) die ($conn->error);

$create = $conn->query($createUsers);
if (!$create) die ($conn->error);

$create = $conn->query($createPosts);
if (!$create) die ($conn->error);

$create = $conn->query($createProfiles);
if (!$create) die ($conn->error);

$insert = $conn->query($copyDegrees);
if (!$insert) die ($conn->error);

echo "Database Created!";

?>
