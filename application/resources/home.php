<?php
$pageTitle = "Resources";
include("../includes/edu_connect.php");
include("../includes/utils.php");
include("../includes/header.php");

$result = mysqli_query($eduConn, "SELECT count,
resource.resource_id, resource.resource_title, description, tags, thumbnail, content,date_created, category_id from resource_view 
inner join resource on resource_view.resource_id = resource.resource_id
order by count DESC Limit 4") or die(mysqli_error($eduConn));

$mostViewCategory = mysqli_query($eduConn, "SELECT count, category.category_id, title FROM category_view 
inner join category on category_view.category_id = category.category_id order by count DESC Limit 6");
?>
<style>
    .category-link,
    .category-link:hover {
        color: #000;
        text-decoration: none;
    }

    .category:hover {
        background-color: #f8f9fa;
        cursor: pointer;
        color: #000;
    }

    .card-img {
        width: 100%;
        height: 225px;
        object-fit: cover;
    }

    .card-img,
    .card-img-bottom {
        border-bottom-right-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }

    .btn {
        background-color: var(--light-red);
        border-radius: 0;
        border-color: var(--light-red);
        color: white;
    }

    .button-one {
        width: 14rem;
    }

    .btn:hover {
        background-color: var(--light-red-hover);
        border-color: var(--light-red-hover);
        color: white;
    }
</style>
<main>
    <!-- Hero -->
    <div class="container py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-1">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="https://source.unsplash.com/random/?beauty,salon,barber" class="rounded d-block mx-lg-auto img-fluid" alt="Educational Resources" style="max-height: 400px;"
                    width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Educational Resources</h1>
                <p class="lead">Browse through dozens of educational resources to advance your career</p>
                <!-- Resource Search Bar -->
                <form action="catalog.php" method="get">
                    <div class="input-group mb-3">
                        <input type="text" name="query" class="form-control" placeholder="What do you want to learn?">
                        <div style="display: flex; justify-content: end;" class=" col-lg-2 col-md-12 find-button-container">
                    <button class="btn button-one" type="submit" id="find-jobs">Search</button>
                </div>
                    </div>
                </form>
                <div class="col-lg-2 col-md-12 find-button-container">
                    <a href="catalog" class="button-one btn btn-primary px-4 me-md-2 rounded">Explore All Resources</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured Resources -->
    <section>
        <div class="container">
            <h3 class="pb-2">Trending Resources</h3>
            <!-- Cards Container -->
            <div class="row">
                <?php while ($row = mysqli_fetch_array($result)) : ?>
                    <?php $description = $row['description'];
                    $arrayDescription = explode(" ", $description);
                    $arrayDescriptionLimit = array_splice($arrayDescription, 0, 15);
                    $displayDescription = join(" ", $arrayDescriptionLimit) . "...";
                ?>
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top card-img" src="<?php echo $row['thumbnail']; ?>">
                        <!-- <img class="card-img-top card-img"
                            src="https://img.youtube.com/vi/<?php //echo $row['content']; ?>/0.jpg"> -->
                        <div class="card-body" style="min-height: 10rem;">
                            <h5 class="card-text"><?php echo $row['resource_title']; ?></h5>
                            <p class="card-text"><?php echo $displayDescription; ?></p>
                        </div>
                        <div class="d-flex justify-content-end align-items-center p-3">
                            <div class="btn-group ">
                                <a href="post?id=<?php echo $row['resource_id']; ?>" class="btn btn-sm  px-3 py-2 rounded">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <!-- Trending Categories -->
    <section class="pb-5 pt-4 py-md-11">
        <div class="container">
            <div class="row align-items-end mb-md-7 mb-2">
                <div class="col-md mb-4 mb-md-0">
                    <h3>Trending Categories</h3>
                </div>
            </div>
            <!-- Cards Container -->
            <div class="row">
                <?php while ($row = mysqli_fetch_array($mostViewCategory)) :  ?>
                    <div class="col-md-4">
                        <a href="catalog?id=<?php echo $row['category_id']; ?>" class="category-link">
                            <div class="card mb-4 box-shadow category">
                                <img class="card-img-top cover" src="" alt="">
                                <div class="card-body">
                                    <h4 class="card-text text-center"><?php echo $row['title']; ?></h4>
                                    <?php
                                    $category_id = $row['category_id'];
                                    $totalResources = mysqli_query($eduConn, "SELECT count(resource_id) AS Total_Resource_for_Category from resource 
                                where resource.category_id = $category_id");
                                    $resource = mysqli_fetch_array($totalResources);
                                    ?>
                                    <p class="card-text text-center"><?php echo $resource['Total_Resource_for_Category']; ?> resources available</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <!-- CTA Banner -->
    <section class="py-5 py-md-11 border-top border-bottom bg-light">
        <div class="container text-center py-xl-4">
            <h2>Advance your career today</h2>
            <div class="font-size-lg mb-md-6 mb-4">Develop new skills with online resources created by experts in your industry</div>
            <div>
                <form class="col-md-4" style="margin: 0 auto;">
                    <!-- Email Input -->
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Type your email address">
                        <div>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
include("../includes/footer.php");
?>