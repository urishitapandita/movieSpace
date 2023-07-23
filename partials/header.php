<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patua+One&family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Link CSS and JS -->
    <link rel="stylesheet" href="styles.css" />
    <script src="index.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <title>Movie Space</title>
</head>

<body>
    <!-- Header Section starts -->
    <nav class="navbar">
        <div class="brand-title"><a href="index.php">Movie Space</a></div>
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="index.php">Movies</a></li>
                <li><a href="series.php">Series</a></li>
                <li><a href="friend.php">Friends</a></li>


                <?php
                $loggedin = false;
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    $loggedin = true;
                }

                if ($loggedin) {
                    echo '<li><a href="profile.php">My Profile</a></li>';
                } else {
                    echo '<li><a href="profile.php">Login</a></li>';
                }

                ?>


            </ul>
        </div>
    </nav>

    <!-- Header Section ends -->