<?php
$pageTitle = "Resources Catalogue";
include("../includes/edu_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .catalog-search {
        display: flex;
        justify-content: space-between;
    }

    .catalog-search>div:last-child {
        min-width: 150px;
        margin-left: 1rem;
    }

    select:hover {
        cursor: pointer;
    }
    .btn{
    background-color: var(--light-red);
        border-radius: 0;
        
        color: white;
    }
    .button-one{
        width: 30rem;
    }
    .btn:hover{
        background-color: var(--light-red-hover);
            color: white;
    }

    /* Medium devices (tablets, 768px and up) */
    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    /* Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {
        .catalog-search {
            margin: 0 auto;
            width: 800px;
            min-width: none;
            margin-bottom: 2rem;
        }
    }
</style>
<?php
$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = isset($_GET['query']) ? $_GET['query'] : '';

// if(isset($_GET['id'])) {
//     $category_id = $_GET['id'];
//     $getcount = mysqli_query($eduConn, "SELECT COUNT(*) from resource
//     WHERE category_id = $category_id ") or die(mysqli_error($eduConn));
// }
// else if(isset($_GET['query'])) {
//     $search = $_GET['query'];
//     $getcount = mysqli_query($eduConn,"SELECT COUNT(*) from resource
//         inner join category on resource.category_id = category.category_id 
//         Where resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%' ") or die(mysqli_error($eduConn));
// }
// else if(isset($_GET['submit'])){
    
    
//     if (isset($_GET['query'])){
//         $search = $_GET['query'];
//         $search_part1 = "AND (resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%')";
//         $getcount = mysqli_query($eduConn,"SELECT COUNT(*) from resource
//         inner join category on resource.category_id = category.category_id 
//         Where resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%' ") or die(mysqli_error($eduConn));
//     } else {
//         $search = "";
//     }   

//     if (isset($_GET['category'])){
//         $category_search = $_GET['category'];
//         $result_1 = mysqli_query($eduConn, "SELECT title, category_id from category
//         WHERE title = '$category_search' ") or die(mysqli_error($eduConn));
//         $row_1= mysqli_fetch_array($result_1);
//         $categoryID = $row_1['category_id'];

//         $getcount = mysqli_query($eduConn,"SELECT COUNT(*) from resource
//         inner join category on resource.category_id = category.category_id 
//         WHERE resource.category_id = $categoryID $search_part1") or die(mysqli_error($eduConn));
//     } else {
//         $category_search = "";
//     }   
// }else{
//     $getcount = mysqli_query($eduConn, "SELECT COUNT(*) from resource") or die(mysqli_error($eduConn));
// }

// $postnum = mysqli_result($getcount, 0);
// //echo $postnum;
// $limit = 4;
// if ($postnum > $limit) {
//     $tagend = round($postnum % $limit, 0);
//     $splits = round(($postnum - $tagend) / $limit, 0);
//     if ($tagend == 0) {
//         $num_pages = $splits;
//     } else {
//         $num_pages = $splits + 1;
//     }
//     if (isset($_GET['pg'])) {
//         $pg = $_GET['pg'];
//     } else {
//         $pg = 1;
//     }
//     $startpos = ($pg * $limit) - $limit;
//     $limstring = "LIMIT $startpos,$limit";
// } else {
//     $limstring = "LIMIT 0,$limit";
// }

// // MySQLi upgrade: we need this for mysql_result() equivalent
// function mysqli_result($res, $row, $field = 0)
// {
//     $res->data_seek($row);
//     $datarow = $res->fetch_array();
//     return $datarow[$field];
// }

if(isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $category_result = mysqli_query($eduConn, "SELECT title from category
    WHERE category_id = $category_id ") or die(mysqli_error($eduConn));
    $category_result = mysqli_fetch_array($category_result);
    $category = $category_result['title'];
    $result = mysqli_query($eduConn, "SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id from resource
    WHERE category_id = $category_id ") or die(mysqli_error($eduConn));
}
else if(isset($_GET['query'])) {
    $search = $_GET['query'];
    $result = mysqli_query($eduConn,"SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id, 
        title, category.category_id from resource
        inner join category on resource.category_id = category.category_id 
        Where resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%' ") or die(mysqli_error($eduConn));

        $search = "";
        $category_search = "";
        $search_part1 = "";
        if (isset($_GET['query'])){
            $search = $_GET['query'];
            $search_part1 = "AND (resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%')";
        
            $result = mysqli_query($eduConn,"SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id, 
            title, category.category_id from resource
            inner join category on resource.category_id = category.category_id 
            Where resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%'") or die(mysqli_error($eduConn));
        } else {
            $search = "";
            $search_part1 = "";
        }   

        if (isset($_GET['category'])){
            $category_search = $_GET['category'];
            $result_1 = mysqli_query($eduConn, "SELECT title, category_id from category
            WHERE title = '$category_search' ") or die(mysqli_error($eduConn));
            $row_1= mysqli_fetch_array($result_1);
            $categoryID = $row_1['category_id'];
    
            $result = mysqli_query($eduConn,"SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id, 
            title, category.category_id from resource
            inner join category on resource.category_id = category.category_id 
            WHERE resource.category_id = $categoryID $search_part1 ") or die(mysqli_error($eduConn));
        } else {
            $category_search = "";
        }   
}
else if(isset($_GET['submit'])){
    $search = "";
    $category_search = "";
    $search_part1 = "";
    if (isset($_GET['query'])){
        $search = $_GET['query'];
        $search_part1 = "AND (resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%')";
       
        $result = mysqli_query($eduConn,"SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id, 
        title, category.category_id from resource
        inner join category on resource.category_id = category.category_id 
        Where resource_title LIKE '%$search%' OR tags LIKE '%$search%' OR content LIKE '%$search%'") or die(mysqli_error($eduConn));
    } else {
        $search = "";
        $search_part1 = "";
    }   

    if (isset($_GET['category'])){
        $category_search = $_GET['category'];
        $result_1 = mysqli_query($eduConn, "SELECT title, category_id from category
        WHERE title = '$category_search' ") or die(mysqli_error($eduConn));
        $row_1= mysqli_fetch_array($result_1);
        $categoryID = $row_1['category_id'];
        echo  $categoryID;

        $result = mysqli_query($eduConn,"SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id, 
        title, category.category_id from resource
        inner join category on resource.category_id = category.category_id 
        WHERE resource.category_id = $categoryID $search_part1 ") or die(mysqli_error($eduConn));
    } else {
        $category_search = "";
    }   
}else{
    $result = mysqli_query($eduConn, "SELECT resource_id, resource_title,thumbnail, tags, content, resource.category_id from resource") or die(mysqli_error($eduConn));
}

?>
<main>
    <!-- Hero -->
    <section class="pt-5 pb-4 text-center container">
        <div class="row pt-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">What do you want to learn?</h1>
                <p class="lead text-muted">Browse through dozens of educational resources to advance your career</p>
            </div>
        </div>
        <!-- Resource search -->
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="get">
            <div class="catalog-search">
                <!-- Search input -->
                <div class="input-group">
                    <input type="text" value="<?php if (isset($_GET['query'])) { echo $_GET['query']; } ?>" name="query" class="form-control" placeholder="What do you want to learn?">
                    <div style="
    display: flex;
    justify-content: end;" class=" col-lg-2 col-md-12 find-button-container">
                    <button class="btn button-one" type="submit" id="find-jobs">Search</button>
                </div>
                </div>
                <!-- Category dropdown -->
                <div class="col-3">
                    <select class="form-select" name="category">
                        <option selected disabled>Category</option>
                        <option value="Esthetics" <?php if ($category == "Esthetics") { echo "selected"; } ?>>Esthetics</option>
                        <option value="Hair Cutting" <?php if ($category == "Hair Cutting") { echo "selected"; } ?>>Hair Cutting</option>
                        <option value="Hair Colouring" <?php if ($category == "Hair Colouring") { echo "selected"; } ?>>Hair Colouring</option>
                        <option value="Hair Styling" <?php if ($category == "Hair Styling") { echo "selected"; } ?>>Hair Styling</option>
                        <option value="Make Up" <?php if ($category == "Make Up") { echo "selected"; } ?>>Make Up</option>
                        <option value="Bride Styling" <?php if ($category == "Bride Styling") { echo "selected"; } ?>>Bride Styling</option>
                        <option value="Nail Styling" <?php if ($category == "Nail Styling") { echo "selected"; } ?>>Nail Styling</option>
                        <option value="Massage Therapy" <?php if ($category == "Massage Therapy") { echo "selected"; } ?>>Massage Therapy</option>
                        <option value="Barbering" <?php if ($category == "Barbering") { echo "selected"; } ?>>Barbering</option>
                        <option value="Hair Removal" <?php if ($category == "Hair Removal") { echo "selected"; } ?>>Hair Removal</option>
                        <option value="Tools" <?php if ($category == "Tools") { echo "selected"; } ?>>Tools</option>
                        <option value="General Discussion" <?php if ($category == "General Discussion") { echo "selected"; } ?>>General Discussion</option>
                    </select>
                </div>
            </div>
        </form>
    </section>
    <!-- Results grid -->
    <div class="mt-4 pb-4">
        <div class="container pt-3">
            <!-- Cards container -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            <?php if ($result->num_rows > 0) : ?>
                <!-- Single card -->
                <?php  while($row = mysqli_fetch_array($result)): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <!-- Card image -->
                        <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" />
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg> -->
                        <img class="card-img-top card-img" src="<?php echo $row['thumbnail']; ?>">
                        <!-- Card body -->
                        <div class="card-body" style="min-height: 5rem;">
                            <p class="card-text"><?php echo $row['resource_title']; ?></p>   
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-2">
                            <div class="btn-group">
                                <a href="post?id=<?php echo $row['resource_id']; ?>" class="btn btn-sm rounded px-3 py-2">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php else : ?>
                    <p class="text-center">No Resources found</p>
                <?php endif ?>
                <!-- <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" />
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="post?id=2" class="btn btn-sm btn-outline-secondary">View</a>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            
            
        </div>
        
    </div>
</main>
<?php
include("../includes/footer.php");
?>