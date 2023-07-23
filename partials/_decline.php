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

    $sql = "DELETE FROM `friends` WHERE `friends`.`user_one` = '$user2' AND `friends`.`user_two`= '$user1';";

    $result = mysqli_query($conn, $sql);
    
    header("Location: /moviespace/friend.php");

}
header("Location: /moviespace/friend.php");

?>
