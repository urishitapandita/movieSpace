<?php 

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
} 

include "/xampp/htdocs/moviespace/db_connect.php";

if(isset($_GET['user1']) && ($_GET['user2'])) {
    
    $user1 = $_GET['user1'];
    $user2 = $_GET['user2'];

    $sql = "UPDATE `friends` SET `is_friends` = '1' WHERE `friends`.`user_one` = '$user2' AND `friends`.`user_two`='$user1';";
    $sql1 = "INSERT INTO `friends` (`user_one`, `user_two`, `is_friends`, `date`) VALUES ('$user1', '$user2', '1', current_timestamp());";

    $result = mysqli_query($conn, $sql);
    $result = mysqli_query($conn, $sql1);
    
    header("Location: /moviespace/friend.php");

}

?>
