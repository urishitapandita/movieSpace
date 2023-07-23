<?php
$showalert = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "/xampp/htdocs/moviespace/db_connect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM user_100 WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $login = true;
                session_start();

                $query = "SELECT `fullname`, `email`, `image` FROM `user_100` WHERE `username`= '$username'";
                $result1 = mysqli_query($conn, $query);
                $row1 = mysqli_fetch_assoc($result1);
                $fullname = $row1['fullname'];
                $email = $row1['email'];
                $image = $row['image'];

                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;

                header("location: index.php");
            } else {
                echo '<script>alert("Error! Please enter a valid username or password")</script>';
            }
        }
    } else {
        echo '<script>alert("Error! Please enter a valid username or password")</script>';
    }
}

include "/xampp/htdocs/moviespace/partials/header.php";

?>


<div class="login">
    <div class="logincontent">
        <div class="loginflex">
            <h2>Login</h2>
            <form action="/moviespace/login.php" method="POST">
                <p>Username</p>
                <input type="text" name="username" placeholder="username">
                <p>Password</p>
                <input type="password" name="password" placeholder="password">
                <button type="submit">Login</button>
            </form>
            <p style="padding-bottom: 3px;">New to this website ?</p>
            <a href="signup.php" class="loginbutton">Signup</a>
        </div>
    </div>
</div>





<?php
include "/xampp/htdocs/moviespace/partials/footer.php"
?>