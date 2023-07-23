<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

include "../moviespace/partials/header.php";
include "../moviespace/db_connect.php";

?>


<!-- Main Section starts -->
<div class="container">
    <h2>Posts/Reviews</h2>
    <br>

    <div class="active-tabs">
        <input type="radio" name="active_tabs" id="btn-1" class="btn-1" checked>
        <label for="btn-1" class="btn">Global</label>

        <input type="radio" name="active_tabs" id="btn-2" class="btn-2">
        <label for="btn-2" class="btn">Friends</label>


        <div class="tabs-container">
            <div class="tab-1 p1">
                <?php

                $sql = "SELECT * FROM post_100";
                $result = mysqli_query($conn, $sql);

                if ($result == TRUE) {
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            $m = $rows['moviename'];
                            $moviename = strtoupper($m);
                            $id = $rows['sno'];
                            $username = $rows['username'];
                            $description = $rows['description'];
                            $time = $rows['time'];
                            $image = $rows['image'];
                ?>
                            <div class="card-container">
                                <div class="float-layout"><a href="movie_thread.php?id=<?php echo $id; ?>">
                                        <div class="card-image">
                                            <img src="image/<?php echo $image; ?>" alt="image" />
                                            <div class="card">
                                                <div class="card-desc">
                                                    <h3><?php echo $moviename; ?></h3>
                                                    <h5>Posted by - <span style="color: orange;"><?php echo strtoupper($username); ?></span></h5>
                                                    <p class="card-timing"><?php echo $time; ?></p>
                                                    <p class="card-detail"><?php echo substr($description, 0, 330); ?>...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                <?php
                        }
                    }
                }

                ?>

            </div>


            <div class="tab-2 p1">
                <?php
                include "/xampp/htdocs/moviespace/partials/moviefriend.php";
                ?>
            </div>

        </div>
    </div>
</div>



<!-- Main Section ends -->
<?php
include "/xampp/htdocs/moviespace/partials/footer.php";
?>