<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}
include "/xampp/htdocs/moviespace/db_connect.php";
$username = $_SESSION['username'];



if(isset($_POST['updateimage'])) {

    $file = $_FILES['image'];

    $imagename = $file['name'];
    // echo $imagename;
    
    $tmplocation = $file['tmp_name'];
    $fileExt = strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
    // echo $fileExt;

    $imagesize = $file['size'];

    $allowedExt = array('jpg', 'jpeg', 'png');
    if(in_array($fileExt, $allowedExt)) {
        if($imagesize < 10000000) {
            $dest = '../image/'.$imagename;
            move_uploaded_file($tmplocation, $dest);
    
            $sql = "UPDATE `user_100` SET `image` ='$imagename' WHERE `user_100`.`username` = '$username';";
            $result = mysqli_query($conn, $sql);
            $_SESSION['image'] = $imagename;

            header("location: /moviespace/profile.php");                
        }
        header("location: /moviespace/profile.php");
    }
    header("location: /moviespace/profile.php");
}
header("location: /moviespace/profile.php");
