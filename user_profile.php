<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "/xampp/htdocs/moviespace/partials/header.php";
include "/xampp/htdocs/moviespace/db_connect.php";
?>


<?php
$username = $_GET['username1'];
$sql1 = "SELECT * FROM `user_100` WHERE username = '$username';";
$result1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_fetch_assoc($result1);

$userfullname1 = $rows1['fullname'];
$userimage1 = $rows1['image'];
$useremail1 = $rows1['email'];


if ($username == $_SESSION['username']) {
	header("Location: profile.php");
	exit;
}

$user = $_SESSION['username'];

$sql2 = "SELECT * FROM friends WHERE (user_one = '$username' AND user_two = '$user')";
$result2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_fetch_assoc($result2);
if ($rows2 == TRUE) {
	$friends = $rows2['is_friends'];
} else if ($rows2 == TRUE) {
	$friends = 0;
} else {
	$friends = 2;
}
$sql3 = "SELECT * FROM friends WHERE (user_one = '$user' AND user_two = '$username')";
$result3 = mysqli_query($conn, $sql3);
$rows3 = mysqli_fetch_assoc($result3);
if ($rows3 == TRUE) {
	$pass = $rows3['is_friends'];
	if ($pass == 0) {
		$friends = 3;
	}
}

?>


<div class="profile">
	<div class="profile1">
		<img src="image/<?php echo $userimage1 ?>" alt="photo">
	</div>
	<div class="profile2">
		<p>Name : <?php echo $userfullname1; ?></p>
		<p>Username : <?php echo $username; ?></p>
		<p>Email : <?php echo $useremail1; ?></p>

		<?php

		if ($friends == 1) {
		?>
			<button style="background-color: red;"><a href="partials/_removefriend.php?user1=<?php echo $user; ?>&user2=<?php echo $username ?>">Remove Friend</a></button>
		<?php
		} else if ($friends == 0) {
		?>
			<button style="background-color: green;"><a href="partials/_accept.php?user1=<?php echo $user; ?>&user2=<?php echo $username ?>">Accept</a></button>
		<?php
		} else if ($friends == 2) {
		?>
			<button style="background-color: green;"><a href="partials/_addfriend.php?user1=<?php echo $user; ?>&user2=<?php echo $username ?>">Add Friend</a></button>
		<?php
		}

		?>




	</div>
</div>











<!-- user Posts/Reviews section starts -->

<div class="profileReview">
	<div class="profileReviewContainer">
		<div class="profileReviewH2">
			<h1>Posts/Reviews</h1>
		</div>
		<div class="underline"> </div>
		<?php

		$sql = "SELECT * FROM post_100 WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);

		if ($result == TRUE) {
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
					$m = $rows['moviename'];
					$moviename = strtoupper($m);
					$username = $rows['username'];
					$description = $rows['description'];
					$time = $rows['time'];
					$image = $rows['image'];
		?>

					<div class="profileCardImage">
						<img src="image/<?php echo $image; ?>" alt="image" />
						<div class="profileCard">
							<h3><?php echo $moviename; ?></h3>
							<h5>Posted by - <?php echo $username; ?></h5>
							<p class="profileTime"><?php echo $time; ?></p>
							<p class="profileDesc"><?php echo $description; ?></p>
						</div>
					</div>
					<hr>

		<?php
				}
			}
		}
		?>






		<?php

		$sql = "SELECT * FROM series_100 WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);

		if ($result == TRUE) {
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
					$m = $rows['seriesname'];
					$seriesname = strtoupper($m);
					$id = $rows['sno'];
					$username = $rows['username'];
					$description = $rows['description'];
					$time = $rows['time'];
					$image = $rows['image'];
		?>

					<div class="profileCardImage">
						<img src="image/<?php echo $image; ?>" alt="image" />
						<div class="profileCard">
							<h3><a href="movie_thread.php?id=<?php echo $id; ?>"><?php echo $seriesname; ?></a></h3>
							<h5>Posted by - <?php echo $username; ?></a></h5>
							<p class="profileTime"><?php echo $time; ?></p>
							<p class="profileDesc"><?php echo $description; ?></p>
						</div>
					</div>
					<hr>

		<?php
				}
			}
		}

		?>










	</div>
</div>

<!-- User Posts/Reviews section ends -->



<?php
include "/xampp/htdocs/moviespace/partials/footer.php";
?>