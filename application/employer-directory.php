<?php
$pageTitle = "Employer Directory";
$accl = "1,0";
include("includes/job_connect.php");
include("includes/edu_connect.php");
include("includes/header.php");
include("includes/_functions.php");

if (isset($_GET['keyword'])) {
	$keyword = $_GET['keyword'];
} else {
	$keyword = "";
}
if (isset($_GET['location'])) {
	$location = $_GET['location'];
} else {
	$location = "";
}

$queryFilter = "";

if (isset($_GET['filter'])) {
	$queryAppend = array();

	if ($keyword != "") {
		array_push($queryAppend, "(business_name LIKE '%$keyword%' OR business_category LIKE '%$keyword%' OR description LIKE '%$keyword%' OR focus LIKE '%$keyword%')");
	}

	if ($location != "") {
		array_push($queryAppend, "(city LIKE '%$location%' OR address LIKE '%$location%' OR postal_code LIKE '%$location%' OR province LIKE '%$location%')");
	}

	foreach ($queryAppend as $k => $v) {
		if ($k == 0) {
			$queryFilter .= " WHERE " . $v;
		} else {
			$queryFilter .= " AND " . $v;
		}
	}
}


$result = mysqli_query($jobConn, "SELECT * FROM employer") or die(mysqli_error($jobConn));
if (isset($_GET['filter'])) {
	$result = mysqli_query($jobConn, "SELECT * FROM employer $queryFilter") or die(mysqli_error($jobConn));
}
?>


<style>
	.employerlink:link,
	.employerlink:visited {
		color: black;
		text-decoration: none;

	}

	img {
		width: 60px;
	}

	input {
		box-shadow: 0px 1px 5px rgb(0 0 0 / 10%);
	}

	.text-dark
	{
		font-size: 3rem;
	}

	.border-info
	{
		border-color: lightgray !important;
	}

	@media (min-width:770px) {
		.desktop-view-button {
			margin-bottom: -1.5rem;
		}

		.job-list-body {
			display: flex;
			flex-wrap: wrap;
		}
	}

	@media (max-width:770px) {

		#advertisement,
		#companies {
			width: 100%;
		}

		#company {
			margin-right: 1rem;
		}
	}
</style>
<main>
	<section class="intro">
		<!-- intro -->
		<div>
			<div class="mask d-flex align-items-center h-100">
				<div class="container">
					<p class=" font-weight-bold mt-5 mb-4 text-dark">Employer Directory</p>
					<div class=" mb-4">
						<div class="card-body">
							<div class="align-items-center ">
								<form class="row container-fluid d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
									<div class="col-md-6 mb-3 mb-md-0">
										<div id="basic" class="form-outline">
											<input type="text" id="keyword" name="keyword" class="form-control form-control-lg" placeholder="What are you looking for?" <?php if ($keyword != "") {
																																											echo "value=\"$keyword\"";
																																										} ?> />
										</div>
									</div>
									<div class="col-md-4 mb-3 mb-md-0">
										<div id="location" class="form-outline">
											<input type="text" id="location" name="location" class="form-control form-control-lg" placeholder="Location" <?php if ($location != "") {
																																								echo "value=\"$location\"";
																																							} ?> />
										</div>
									</div>
									<div class="col-md-2">
										<input style=" color: white; background-color: var(--light-red);" class="btn btn-block btn-lg w-100 desktop-view-button" type="submit" value="Search" name="filter" id="filter" />
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- intro -->
	<div class="container">
		<!-- container -->
		<div id="job-list-body" class="mb-4 w-100 row job-list-body">
			<!-- job-list-body -->
			<section id="companies" class="col-9">
				<!-- companies -->

				<?php while ($row = mysqli_fetch_array($result)) : ?>
					<div id="company" class="row">
						<div class="mx-3">
							<div class="card mb-4 box-shadow w-100 mt-4 shadow">
								<div class="card-header">
									<div class="d-flex justify-content-between">
										<div class="m-1">
											<?php
											if ($row['profile_image'] == "") {
												$profileImage = $companyProfileImagePath . "company_default.png"; //path can be changed in the _function.php file
											} else {
												$profileImage = $companyProfileImagePath . $row['profile_image'];
											}
											echo "<img src=\"$profileImage\" alt=\"company profile picture\">";
											?>
										</div>
										<div>
											<a class="btn btn-sm btn-soft-primary pencil-bg" href="employer-profile?id=<?php echo $row['user_id']; ?>">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
													<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
													<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
												</svg> View Profile
											</a>

										</div>
									</div>

									<div>
										<h4 class="my-0"><?php echo $row['business_name']; ?></h4>
										<ul class="list-unstyled m-1">
											<li><?php echo $row['city']; ?></li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<ul class="list-unstyled m-1">
										<?php
										$theEmployerID = $row['employer_id'];
										$jobDetails = mysqli_query($jobConn, "SELECT * FROM job WHERE employer_id = '$theEmployerID' ORDER BY post_date DESC") or die(mysqli_error($jobConn));
										$jobDetail = mysqli_fetch_array($jobDetails);
										$postDate = strtotime($jobDetail['post_date']);
										?>
										<li>Number of Jobs Posted: <?php echo mysqli_num_rows($jobDetails); ?> </li>
										<li>Last Job Post: <?php echo date("Y-m-d", $postDate); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</section>
			<!-- companies -->
			<?php
			$result = mysqli_query($eduConn, "SELECT count,
			resource.resource_id, resource.resource_title, description, tags, thumbnail, content,date_created, category_id from resource_view 
			inner join resource on resource_view.resource_id = resource.resource_id
			order by count DESC Limit 4") or die(mysqli_error($eduConn));
			?>
			<section id="advertisement" class="col-3 mt-3">
				<!-- advertisement -->
				<div class=" m-2 p-3">
					<h3 class="pb-2 text-center">Trending Resources</h3>
					<!-- Cards Container -->
					<div class="row">
						<?php while ($row = mysqli_fetch_array($result)) : ?>
							<?php $description = $row['description'];
							$arrayDescription = explode(" ", $description);
							$arrayDescriptionLimit = array_splice($arrayDescription, 0, 15);

							$displayDescription = join(" ", $arrayDescriptionLimit) . "...";
							?>
							<div>
								<div class="card mb-4 box-shadow">
									<img class="card-img-top card-img" src="<?php echo $row['thumbnail']; ?>">
									<div class="card-body" style="min-height: 10rem;">
										<h5 class="card-text"><?php echo $row['resource_title']; ?></h5>
										<p class="card-text"><?php echo $displayDescription; ?></p>
									</div>
									<div class="d-flex justify-content-end align-items-center p-3">
										<div class="btn-group ">
											<a href="post?id=<?php echo $row['resource_id']; ?>" class="btn btn-re btn-sm px-3 py-2 rounded">View</a>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
			<!-- advertisement -->
		</div>
		<!-- job-list-body -->
	</div>
	<!-- container -->
</main>
<?php
include("includes/footer.php");
?>