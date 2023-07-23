<?php 

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "/xampp/htdocs/moviespace/db_connect.php";

$username = $_SESSION['username'];
$id = $_GET['id'];
$desc = $_POST['desc'];
$userimage = $_SESSION['image'];


$sql = "INSERT INTO `comments` (`username`, `userimage`, `comment_desc`, `comment_cat_id`, `time`) VALUES ('$username', '$userimage', '$desc', '$id', current_timestamp());";
$result = mysqli_query($conn, $sql);

header("location: ../movie_thread.php?id=$id");


?>