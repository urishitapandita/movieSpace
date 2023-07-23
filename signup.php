<?php

// checking for details entered by the user, if correct then create account
$showalert = false;
$showerror = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "/xampp/htdocs/moviespace/db_connect.php";
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    $sql1 = "SELECT * FROM user_100 WHERE username = '$username'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) == 1) {
        $exists = true;
        echo '<script>alert("Error! Please enter a different username. This name is already taken")</script>';
    }
    else if (($password == $cpassword) && $exists == false) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user_100` (`fullname`, `username`, `email`, `image`, `password`, `date`) VALUES ('$fullname', '$username', '$email', 'NULL.jpg', '$hash', current_timestamp());";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showalert = true;
        }
    }
    else if ($password != $cpassword) {
        $showerror = true;
    }
}
// include header file
include "/xampp/htdocs/moviespace/partials/header.php";

// showing dialog box of account creation
if ($showalert == true) {
    echo '<script>alert("Congratulations! Your account is created and you login now")</script>';
}

if ($showerror == true) {
    echo '<script>alert("Error! Please enter same password")</script>';
}
?>


<!-- form layout -->
<div class="login">
    <div class="logincontent">
        <div class="loginflex">
            <h2>Sign Up</h2>
            <form action="/moviespace/signup.php" method="POST">
                <p>Full Name</p>
                <input type="text" name="fullname" placeholder="Enter your name" required>
                <p>Username</p>
                <input type="text" name="username" placeholder="Username" required minlength="6">
                <p>Email</p>
                <input type="email" name="email" placeholder="Enter your email" required>
                <p>Password</p>
                <input type="password" name="password" placeholder="Password" required minlength="6">
                <p>Confirm Password</p>
                <input type="password" name="cpassword" placeholder="Confirm password" required minlength="6">


                <!-- echo '<p>Enter the 6 digit OTP</p>';
                echo '<input type="text" name="otp" placeholder="OTP" required minlength="6">'; -->

                <button type="submit">Submit</button>
            </form>
            <p style="padding-bottom: 3px;">Already a user ?</p>
            <a href="login.php" class="loginbutton">Login</a>
        </div>
    </div>
</div>




<!-- include footer files -->
<?php
include "/xampp/htdocs/moviespace/partials/footer.php"
?>