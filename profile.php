<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}

include "/xampp/htdocs/moviespace/partials/header.php";
include "/xampp/htdocs/moviespace/db_connect.php";
?>


<div class="profile">
	<div class="profile1">
		<img src="image/<?php echo $_SESSION['image'] ?>" alt="photo">
		<div class="updatePhoto" onclick="show_hide1()">
			<span>Update Image</span>
		</div>
	</div>
	<div class="profile2">
		<p>Name : <?php echo $_SESSION['fullname']; ?></p>
		<p>Username : <?php echo $_SESSION['username']; ?></p>
		<p>Email : <?php echo $_SESSION['email']; ?></p>
		<a class="logoutbutton" href="logout.php">Logout</a>
	</div>
</div>
<div id="updateImage">
	<form method="POST" action="partials/updateimage.php" enctype="multipart/form-data">
		<input type="file" name="image">
		<br>
		<span>Please choose an image upto 5MB </span>
		<button type="submit" name="updateimage" value="UPLOAD" style="padding: 3px 7px;">Submit</button>
	</form>
</div>



<div class="postform">
	<button class="addpost" onclick="show_hide()">
		<span>Add Movie Review</span>
	</button>
	<button class="addpost" onclick="show_hide2()">
		<span>Add Series Review</span>
	</button>
	<div class="postform1">
		<div class="postform2" id="postform3">
			<form method="POST" action="partials/addpost.php" enctype="multipart/form-data">
				<p>Enter the name of Movie</p>
				<input type="text" name="moviename" placeholder="Movie name" required minlength="4"><br>
				<p>Choose image (upto 5 MB)</p>
				<input type="file" name="image" required>
				<p>Movie description</p>
				<textarea name="description" cols="50" rows="10" required minlength="5"></textarea><br>
				<button type="submit" name="imagesubmit" value="UPLOAD">Submit</button>
			</form>
		</div>

		<div class="postform2" id="postform4">
			<form method="POST" action="partials/addpost1.php" enctype="multipart/form-data">
				<p>Enter the name of Series</p>
				<input type="text" name="seriesname" placeholder="Series name" required minlength="4"><br>
				<p>Choose image (upto 5 MB)</p>
				<input type="file" name="image" required>
				<p>Series description</p>
				<textarea name="description" cols="50" rows="10" required minlength="5"></textarea><br>
				<button type="submit" name="imagesubmit" value="UPLOAD">Submit</button>
			</form>
		</div>
	</div>
</div>






















<!-- My Posts/Reviews section starts -->

<div class="profileReview">
	<div class="profileReviewContainer">
		<div class="profileReviewH2">
			<h1>My Posts/Reviews</h1>
		</div>
		<div class="underline"> </div>
		<?php
		$username = $_SESSION['username'];

		$sql = "SELECT * FROM post_100 WHERE username = '$username'";
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

					<div class="profileCardImage">
						<img src="image/<?php echo $image; ?>" alt="image" />
						<div class="profileCard">
							<h3><a href="movie_thread.php?id=<?php echo $id; ?>"><?php echo $moviename; ?></a></h3>
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

<!-- My Posts/Reviews section ends -->



<?php
include "/xampp/htdocs/moviespace/partials/footer.php";
?>