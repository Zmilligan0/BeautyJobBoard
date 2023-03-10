<?php
$pageTitle = "Candidate Directory";
$search_part2 = $provinces = "";
$accl = "0,1";
include("includes/job_connect.php");
include("includes/edu_connect.php");
include("includes/utils.php");
include("includes/header.php");
include("includes/_functions.php");

if (isset($_GET['user_id'])) {
	$id = $_GET['user_id'];
	$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result);

		$_SESSION['employer_id'] = $row['employer_id'];
	} else {
		$message = "<p>There was a problem retrieving the inforamtion</p>";
	}
}
//$employer_id = $_SESSION['employer_id'];


if (isset($_GET['candidate-search'])) {
	$job_search = $_GET['candidate-search'];
	$search_part1 = "AND (first_name LIKE '%$job_search%' OR last_name LIKE '%$job_search%' OR skills LIKE '%$job_search%')";
} else {
	$job_search = "";
	$search_part1 = "";
}

if (isset($_GET['location'])) {
	$provinces = $_GET['location'];
	$search_part2 = "AND (city LIKE '%$provinces%' OR province LIKE '%$provinces%')";
} else {
	$provinces = "";
	$search_part2 = "";
}
if (isset($_GET['id'])){
    $_GET['id'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}



// Pagination
$limit = 10;
$count_sql ="SELECT COUNT(*) from candidate where visibility = 1 $search_part1 $search_part2";
$count_result = mysqli_query($jobConn, $count_sql);
$count_row = mysqli_fetch_row($count_result);
$count_of_records = $count_row[0];

if ($count_of_records > $limit)
{
    $end = round($count_of_records % $limit, 0);
    $splits = round(($count_of_records - $end) / $limit, 0);

    if ($end !=0)
    {
        $number_of_pages = $splits + 1;
    }
    else
    {
        $number_of_pages = $splits;
    }

    $start_position = ($page * $limit) - $limit;

    $limit_string = "LIMIT $start_position, $limit";
    
} else {
    $limit_string = "LIMIT 0, $limit";
}
if (!defined("THIS_PAGE")){
    define("THIS_PAGE", $_SERVER['PHP_SELF']);
}
?>

<style>
	.pencil-bg {
		background-color: #eef0fc;
		color: #556ee6;
	}

	.pencil-bg:hover {
		color: #eef0fc;
		background-color: #556ee6;
	}

	.btn-re {
        background-color: var(--light-red);
        border-radius: 0;
        border-color: var(--light-red);
        color: white;
    }

    .btn-re:hover {
        background-color: var(--light-red-hover);
        border-color: var(--light-red-hover);
        color: white;
    }

	@media (min-width:770px) {
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
			<!-- background-color -->
			<div class="mask d-flex align-items-center h-100">
				<!-- mask -->
				<div class="container">
					<!-- container -->
					<p class="display-4 font-weight-bold mt-3 mb-4 text-dark">Candidate Directory</p>
					<div class="card mb-4">
						<!-- card -->
						<div class="card-body">
							<!-- card body -->
							<div class="row justify-content-center align-items-center ">
							
								<!-- row -->
								<div class="col-md-6 mb-3 mb-md-0">
									<form class="row container-fluid d-flex justify-content-center" method="GET" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
										<!-- col1 -->
										<div id="basic" class="form-outline">
											<input type="text" id="candidate-search" name="candidate-search" class="form-control form-control-lg" placeholder="Name or Skills" />
										</div>
								</div>
								<!-- col1 -->
								<div class="col-md-4 mb-3 mb-md-0">
									<!-- col2 -->
									<div id="location" class="form-outline">
										<!-- <label class="form-label" for="form2">Location</label> -->
										<input type="text" id="location" name="location" class="form-control form-control-lg" placeholder="Location" />
									</div>
								</div>
								<div class="col-md-2">
									<!-- col3 -->
									<button style=" color: white; background-color: var(--light-red);" class="btn  btn-block btn-lg w-100 desktop-view-button" type="submit" name="find-jobs" id="find-jobs">Search</button>

								</div>
								</form>
							</div>
							<!-- row -->
						</div>
						<!-- card body -->
					</div>
					<!-- card -->
				</div>
				<!-- container -->
			</div>

			<?php
			// $provinces = array(
			// 	"AB" => "alberta",
			// 	"BC" => "british columbia",
			// 	"MB" => "manitoba",
			// 	"NB" => "new brunswick",
			// 	"NL" => "newfoundland and labrador",
			// 	"NT" => "northwest territories",
			// 	"NS" => "nova scotia",
			// 	"NU" => "nunavut",
			// 	"ON" => "ontario",
			// 	"PE" => "prince edward island",
			// 	"QC" => "quebec",
			// 	"SK" => "saskatchewan",
			// 	"YT" => "yukon"
			// );
			// $query_one = isset($_GET['candidate-search']) ? trim($_GET['candidate-search']) : null;
			// $query_two = isset($_GET['location']) ? trim($_GET['location']) : null;
			// $list_sql = "";

			// $city = null;
			// $province = null;

			// if (strlen($query_two) > 1) {
			// 	$query_two = preg_replace('/[^a-zA-Z ]/', '', $query_two);
			// 	foreach ($provinces as $key => $value) {
			// 		if (preg_match("/\b$key\b/i", $query_two)) {
			// 			$province = $provinces[$key];
			// 			$city = strtolower(preg_replace("/\b$key\b/i", "", $query_two));
			// 		} else if (preg_match("/\b$value\b/i", $query_two)) {
			// 			$province = $value;
			// 			$city = strtolower(preg_replace("/\b$value\b/i", "", $query_two));
			// 		}
			// 	}
			// }
			$list_sql = "SELECT * from candidate where visibility = 1 $search_part1 $search_part2 $limit_string";

			// if (isset($_GET['find-jobs']) || isset($_GET['candidate-search']) || isset($_GET['location'])) {

			// 	$list_sql = "SELECT * from candidate where visibility = 1 AND (first_name LIKE '%$query_one%' OR last_name LIKE '%$query_one%' OR skills LIKE '%$query_one%') AND (city LIKE '%$city%') OR (province LIKE '%$province%')";
			// }

			$list_result = $jobConn->query($list_sql);
			// echo $list_sql;
			// echo $query_one;
			// echo $query_two;
			?>
			<!-- row -->
		</div>
		<!-- w-100 -->
		</div>
		<!-- background-color -->
	</section>
	<!-- intro -->
	<div class="container">
		<!-- container -->


		<div id="job-list-body" class="mb-4 w-100 row job-list-body">
			<!-- job list body -->

			<?php if ($list_result->num_rows > 0) : ?>


				<section id="companies" class="col-9">
					<?php while ($row = $list_result->fetch_assoc()) : ?>
						<!-- companies -->
						<div id="company" class="row">
							<!-- company row1 -->
							<div class="mx-3">
								<div class="card mb-4 box-shadow w-100 mt-4">
									<div class="card-header">
										<div class="d-flex justify-content-between">
											<?php
											if ($row['profile_photo'] == "") {
												$profile_photo = $companyProfileImagePath . "default.png";
											} else {
												$profile_photo = $companyProfileImagePath . $row['profile_photo'];
											}
											?>
											<div class="d-flex align-content-evenly">
												<div class="d-sm-flex mt-1 d-flex justify-content-around ">
													<img src="<?php echo $profile_photo; ?>" alt="<?php echo $profile_photo ?>" class="rounded-circle mx-2" height="100" width="100">
												</div>
												<div>
													<h4 class="my-0 font-weight-normal"><?php echo $row['first_name'] . " " . $row['last_name']; ?></h4>
													<p><?php echo $row['city'] . " " . $row['province']; ?>
													</p>
												</div>
											</div>
											<?php $candidate_id = $row['user_id']; ?>
											<div><a class="btn btn-sm btn-soft-primary pencil-bg" href="candidate-profile.php?id=<?php echo $candidate_id; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
														<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
														<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
													</svg> View Profile</a></div>
										</div>

									</div>
									<div class="card-body">
										<p><?php echo $row['skills'] ?></p>
										<p><?php echo $row['personal_description'] ?></p>
									</div>
								</div>
							</div>
						</div>

					<?php endwhile ?>
				<?php else : ?>
					<p>No Data found</p>

				<?php endif ?>
				<?php if ($count_of_records > $limit) : ?>
    <div class="pages">
        <ul class="pagination">
            <?php
            $next_page = $page + 1;
            $previous_page = $page - 1;
            $page_limiter = 5;

            $query_string = THIS_PAGE . "?candidate-search=$job_search&location=$provinces&page=";
            ?>


            <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column-reverse">
                    <p class="text-muted mb-0">Page <b><?= $page; ?></b> of <b><?= $number_of_pages ?></b></p>
                    <div class="col-auto">
                        <div class=" d-inline-block ms-auto mb-0">
                            <div class="p-2">
                                <nav aria-label="Page navigation example" class="mb-0">
                                    <ul class="pagination mb-0">
                                        <li class="page-item">
                                            <?php if ($page > 1) : ?>
                                                <a class="page-link" href=" <?php echo "$query_string$previous_page"; ?>">
                                                    «</a>
                                        </li>
                                    <?php else : ?>
                                        <span class="page-link text-muted" href=" <?php echo "$query_string$previous_page"; ?>">
                                            «</span>
                                        </li>
                                    <?php endif ?>
                                    <?php for ($i = 1; $i <= $number_of_pages; $i++) : ?>

                                        <?php if ($i == $page) : ?>
                                            <li class="page-item"><span class="page-link active" disabled><?php echo $i; ?></span></li>
                                        <?php else : ?>
                                            <?php if ($i > $page_limiter) : ?>
                                                <li class="page-item"><span class="page-link text-muted">...</span></li>
                                                <li class="page-item"><a class="page-link " href="<?php echo "$query_string$i"; ?>"><?php echo $i; ?></a></li>
                                                <?php break; ?>
                                            <?php endif ?>
                                            <li class="page-item"><a class="page-link " href="<?php echo "$query_string$i"; ?>"><?php echo $i; ?></a></li>
                                        <?php endif ?>


                                    <?php endfor ?>
                                    <?php if ($page < $number_of_pages) : ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo "$query_string$next_page"; ?>">»</a></li>
                                    <?php else : ?>
                                        <li class="page-item"><span class="page-link text-muted" href="<?php echo "$query_string$next_page"; ?>">»</span></li>
                                    <?php endif ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ?>
				<!-- company row1 -->

				<!-- company row2 -->

				<!-- company row3 -->
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
					<div class="m-2 p-3">
						<h3 class="pb-2 text-center">Trending Resources</h3>
						<!-- Cards Container -->
						<div class="row">
							<?php  while($row = mysqli_fetch_array($result)): ?>
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
		<!-- job list body -->
	</div>
	<!-- container -->
</main>
<?php include 'includes/footer.php' ?>