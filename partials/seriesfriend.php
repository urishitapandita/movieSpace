<!-- Friends section Starts -->

<?php 

$username = $_SESSION['username'];
$sql1 = "SELECT * FROM friends WHERE user_one = '$username' AND is_friends ='1'";
$result1 = mysqli_query($conn, $sql1);
if($result1 == TRUE) {
	$count1 = mysqli_num_rows($result1);
	if ($count1 > 0) {
        while ($rows1 = mysqli_fetch_assoc($result1)) {
            $user = $rows1['user_two'];

			$sql = "SELECT * FROM series_100 WHERE username = '$user'";
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
						<div class="card-container">
							<div class="float-layout"><a href="series_thread.php?id=<?php echo $id; ?>">
								<div class="card-image">
									<img src="image/<?php echo $image; ?>" alt="image" />
									<div class="card">
										<div class="card-desc">
											<h3><?php echo $seriesname; ?></h3>
											<h5>Posted by - <?php echo $username; ?></h5>
											<p class="card-timing"><?php echo $time; ?></p>
											<p class="card-detail"><?php echo substr($description, 0, 370); ?></p>
										</div>
									</div>
								</div></a>
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


<!-- Friends section Ends -->