<?php
$accl = "1,1";
$pageTitle = "Educational Posting";
include("../includes/edu_connect.php");
include("../includes/utils.php");
$resourceId = "";
if (isset($_GET['id'])) {
    $resourceId = $_GET['id'];
} else {
    header('Location: home');
}
include("../includes/header.php");
$year = date('Y');
$month = date('m');

$result = mysqli_query($eduConn, "SELECT * from resource WHERE resource_id = $resourceId ") or die(mysqli_error($eduConn));
$row = mysqli_fetch_array($result);

$categoryId = $row['category_id'];

$randomCategory = mysqli_query($eduConn, "SELECT * FROM category ORDER BY RAND() LIMIT 6");

?>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content -->
                <article>
                    <!-- Post header -->
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1"><?php echo $row['resource_title']; ?></h1>
                        <p class="text-muted fst-italic"><?php echo $row['description']?></p>
                        <div class="text-muted fst-italic">Posted on <?php echo date('F j, Y',strtotime($row['date_created'])); ?></div>
                        <?php 
                            $tagArray = explode(",", $row['tags']);
                            echo "<div class=\"d-flex d-inline-flex \">";
                                foreach($tagArray as $value){                           
                                    echo "<p class=\"badge bg-secondary text-decoration-none link-light ms-1\">$value</p>";    
                                }
                            echo "</div>";
                        ?>
                    </header>
                    <div id="resource_content">

                    </div>
                    <!-- Initialize Quill editor -->
                    <?php echo $row['content']; ?>
                </article>
            </div>
            <!-- Side widgets -->
            <div class="col-lg-4">
                <!-- Search widget -->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form action="catalog.php" method="get">
                            <div class="input-group">
                                <input class="form-control" type="text" name="query" placeholder="Enter search term..."
                                    aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Categories widget -->
                <div class="card mb-4">
                    <div class="card-header">Other Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                                while($row = mysqli_fetch_array($randomCategory)){
                                    $category_id = $row['category_id'];
                                    $title = $row['title'];
                                    echo "\n<div class=\"col-sm-6\">";
                                        echo "<a href=\"catalog?id=$category_id\">$title</a><br />\n";
                                    echo "\n</div>";
                                }
                            ?>
                            <!-- <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Web Design</a></li>
                                    <li><a href="#!">HTML</a></li>
                                    <li><a href="#!">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">JavaScript</a></li>
                                    <li><a href="#!">CSS</a></li>
                                    <li><a href="#!">Tutorials</a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Side widget -->
                <!-- <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to
                        use, and feature the Bootstrap 5 card component!</div>
                </div> -->
            </div>
        </div>
    </div>
</main>
<?php
$resource = mysqli_query($eduConn, "SELECT * FROM resource_view WHERE resource_id = $resourceId AND month = $month AND year = $year");
if (mysqli_num_rows($resource) == 1) {
    mysqli_query($eduConn, "UPDATE resource_view SET count = count + 1 WHERE resource_id = $resourceId AND month = $month AND year = $year") or die(mysqli_error($eduConn));
} else {
    $sql = "INSERT INTO resource_view (resource_id, count, month, year) VALUES ($resourceId, 1, $month, $year)";
    mysqli_query($eduConn, $sql);
}

$category = mysqli_query($eduConn, "SELECT * FROM category_view WHERE category_id = $categoryId AND month = $month AND year = $year");
if (mysqli_num_rows($category) == 1) {
    mysqli_query($eduConn, "UPDATE category_view SET count = count + 1 WHERE category_id = $categoryId AND month = $month AND year = $year") or die(mysqli_error($eduConn));
} else {
    $sql = "INSERT INTO category_view (category_id, count, month, year) VALUES ($categoryId, 1, $month, $year)";
    mysqli_query($eduConn, $sql);
}
include("../includes/footer.php");
?>