<?php

$user = $_SESSION['username'];
$sql = "SELECT * FROM friends WHERE user_one = '$user' AND is_friends ='1';";
$result = mysqli_query($conn, $sql);

if($result == TRUE) {

    $count = mysqli_num_rows($result);
    if($count>0) {        
        
        while ($rows = mysqli_fetch_assoc($result)) {
            
            $username = $rows['user_two'];
            $sql1 = "SELECT * FROM user_100 WHERE username = '$username'";
            $result1 = mysqli_query($conn, $sql1);

            if ($result1 == TRUE) {


                $count1 = mysqli_num_rows($result1);
                if ($count1 > 0) {


                    while ($rows1 = mysqli_fetch_assoc($result1)) {
                        $username1 = $rows1['username'];
                        $fullname = strtoupper($rows1['fullname']);
                        $id = $rows1['sno'];
                        $image = $rows1['image'];
                        if ($username1 == $_SESSION['username']) {
                            continue;
                        }
            ?>
            
                        <div class="all-user">
                            <div class="user-container">
                                <div class="image1">
                                    <img src="image/<?php echo $image; ?>" alt="image">
                                </div>
                                <div class="content1">
                                    <h3><?php echo $fullname; ?></h3>                                    
                                    <button><a href="user_profile.php?username1=<?php echo $username; ?>">View Profile</a></button>
                                    <button style="background-color: red;"><a href="partials/_removefriend.php?user1=<?php echo $user;?>&user2=<?php echo $username?>">Remove Friend</a></button>
                                </div>
                            </div>
                        </div>
            
            <?php
                    }
                }
            }
        }
    }
}

?>