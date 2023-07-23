<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
	header("location: login.php");
	exit;
}
include "/xampp/htdocs/moviespace/partials/header.php";
include "/xampp/htdocs/moviespace/db_connect.php";
?>


<div class="container-friend">
	<div class="myimage">
		<div class="imagesize">
			<img src="image/<?php echo $_SESSION['image'] ?>" alt="">
		</div><br>
	</div>

</div>

<div class="container-friend" style="margin-top: 0;">
	<div class="myimage" style="padding-bottom: 2%;">
		<h1 style="color: orange;"><?php echo strtoupper($_SESSION['fullname']); ?></h1>
	</div>
</div>



<div class="container-friend1">
	
	<div class="active-tabs">
		<input type="radio" name="active_tabs" id="btn-1" class="btn-1" checked>
		<label for="btn-1" class="btn">Users</label>

		<input type="radio" name="active_tabs" id="btn-2" class="btn-2">
		<label for="btn-2" class="btn">Request</label>

		<input type="radio" name="active_tabs" id="btn-3" class="btn-3">
		<label for="btn-3" class="btn">My Friends</label>

		<input type="radio" name="active_tabs" id="btn-4" class="btn-4">
		<label for="btn-4" class="btn"><a href="logout.php">Logout</a></label>


		<div class="tabs-container">
			<div class="tab-1 p1">

				<?php

				$sql = "SELECT * FROM user_100;";
				$result = mysqli_query($conn, $sql);


				$user = $_SESSION['username'];
				if ($result == TRUE) {
					$count = mysqli_num_rows($result);
					if ($count > 0) {
						while ($rows = mysqli_fetch_assoc($result)) {
							$username = $rows['username'];
							$fullname = strtoupper($rows['fullname']);
							$image = $rows['image'];
							if ($username == $user) {
								continue;
							}
							$friends = 2;
							$sql2 = "SELECT * FROM friends WHERE (user_one = '$username' AND user_two = '$user')";
							$result2 = mysqli_query($conn, $sql2);
							$rows2 = mysqli_fetch_assoc($result2);
							// $pass = $rows2['is_friends'];
							if ($rows2 == TRUE) {
								$pass = $rows2['is_friends'];
								if($pass ==1) {
									$friends =1;
								}
								else if ($pass ==0) {
									$friends =0;
								}
							}
							$sql3 = "SELECT * FROM friends WHERE (user_one = '$user' AND user_two = '$username')";
							$result3 = mysqli_query($conn, $sql3);
							$rows3 = mysqli_fetch_assoc($result3);
							if ($rows3 == TRUE) {
								$pass = $rows3['is_friends'];
								if ($pass ==0) {
									$friends =3;
								}
							}
				?>

					<div class="all-user">
						<div class="user-container">
							<div class="image1">
								<img src="image/<?php echo $image; ?>" alt="">
							</div>
							<div class="content1">
								<h3><?php echo $fullname; ?></h3>
								<button><a href="user_profile.php?username1=<?php echo $username; ?>">View Profile</a></button>

								<?php

								if ($friends == 1) {
								?>
									<button style="background-color: red;"><a href="partials/_removefriend.php?user1=<?php echo $user;?>&user2=<?php echo $username?>">Remove Friend</a></button>
								<?php
								} 
								else if ($friends == 0) {
								?>
									<button style="background-color: green;"><a href="partials/_accept.php?user1=<?php echo $user;?>&user2=<?php echo $username?>">Accept</a></button>
								<?php
								} 
								else if ($friends == 2) {
								?>
									<button style="background-color: green;"><a href="partials/_addfriend.php?user1=<?php echo $user;?>&user2=<?php echo $username?>">Add Friend</a></button>
								<?php
								}
								
								

								?>

							</div>
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
				include "/xampp/htdocs/moviespace/partials/request.php";
				?>
			</div>

			<div class="tab-3 p1">
				<?php
				include "/xampp/htdocs/moviespace/partials/myfriend.php";
				?>

			</div>

		</div>
	</div>
</div>



<?php

include "/xampp/htdocs/moviespace/partials/footer.php";
?>
