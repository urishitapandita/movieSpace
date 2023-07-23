<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}
include "/xampp/htdocs/moviespace/db_connect.php";
$username = $_SESSION['username'];
$g = $_POST["seriesname"];
$seriesname = strtoupper($g);
$description = $_POST["description"];


if(isset($_POST['imagesubmit'])) {
    $file = $_FILES['image'];

    $imagesize = $file['size'];
    if($imagesize == 0) {
        $imagename = "NULL.jpg";
    }
    else {
        $imagename = $file['name'];
    }
    $tmplocation = $file['tmp_name'];


    $fileExt = strtolower(pathinfo($imagename, PATHINFO_EXTENSION));

    $allowedExt = array('jpg', 'jpeg', 'png');
    if(in_array($fileExt, $allowedExt)) {
        if($imagesize < 5000000) {
            $dest = '../image/'.$imagename;
            move_uploaded_file($tmplocation, $dest);

            $sql = "INSERT INTO `series_100` (`image`, `seriesname`, `username`, `time`, `description`) VALUES ('$imagename', '$seriesname', '$username', current_timestamp(), '$description');";
            $result = mysqli_query($conn, $sql);
            header("location: /moviespace/profile.php");
        }
        header("location: /moviespace/profile.php");
    }
    header("location: /moviespace/profile.php");
}

?>