<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}
include "/xampp/htdocs/moviespace/partials/header.php";
include "/xampp/htdocs/moviespace/db_connect.php"
?>

<br>











<div class="profileReview">
	<div class="profileReviewContainer">

		<?php
		$id = $_GET['id'];
		$username = $_SESSION['username'];

		$sql = "SELECT * FROM `series_100` WHERE sno = $id;";
		$result = mysqli_query($conn, $sql);

		if ($result == TRUE) {
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
					$m = $rows['seriesname'];
					$seriesname = strtoupper($m);
					$username = $rows['username'];
					$description = $rows['description'];
					$time = $rows['time'];
					$image = $rows['image'];
		?>
					<div class="profileCardImage">
						<img src="image/<?php echo $image; ?>" alt="image" />
						<div class="profileCard">
							<h3><?php echo $seriesname; ?></h3>
							<h5>Posted by - <a style="color: orange;" href="user_profile.php?username1=<?php echo $username; ?>"><?php echo strtoupper($username); ?></a></h5>
							<p class="profileTime"><?php echo $time; ?></p>
							<p style="padding-top: 5px;" class="profileDesc"><?php echo $description; ?></p>
						</div>
					</div>
		<?php
				}
			}
		}
		?>




		<br><br>
		<h2 style="font-weight: bolder;">Comments</h2>

		<form class="comments" action="partials/addseriescomment.php?id=<?php echo $id; ?>" method="POST">
			<input type="text" placeholder="Write Comment" name="desc" required>
			<button>Add Comment</button>
		</form>

		<br>



		<?php

		$sql1 = "SELECT * FROM series_comment WHERE comment_cat_id=$id;";
		$result1 = mysqli_query($conn, $sql1);

		if ($result1 == TRUE) {
			$count1 = mysqli_num_rows($result1);
			if ($count1 > 0) {
				while ($rows1 = mysqli_fetch_assoc($result1)) {

					$username1 = $rows1['username'];
					$description1 = $rows1['comment_desc'];
					$image1 = $rows1['userimage'];
		?>
					<div class="user-comment">
						<div class="comment-image">
							<img src="image/<?php echo $image1; ?>" alt="">
						</div>
						<div class="content1">
							<h3><?php echo $username1; ?></h3>
							<p style="padding-top: 0.7%;"><?php echo $description1; ?></p>


						</div>
					</div>


		<?php
				}
			}
		}
		?>
























	</div>
</div>



















<?php
include "/xampp/htdocs/moviespace/partials/footer.php";
?>