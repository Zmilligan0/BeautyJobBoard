<?php  
    $accl = "0,0";
    $pageTitle = "Educational Resource Management";
    include ("../includes/edu_connect.php");
    include ("../includes/utils.php");
    include ("../includes/header.php");
?>

<?php
    if(isset($_GET['resource_id']) && is_numeric($_GET['resource_id'])){
        $resourceID = strip_tags(trim($_GET['resource_id']));
    } else {
        $resourceID = "";
    }
    if(isset($_GET['key_word'])){
        $keyWord = strip_tags(trim($_GET['key_word']));
    } else {
        $keyWord = "";
    }
    if(isset($_GET['category'])){
        $category = $_GET['category'];
    } else {
        $category = "";
    }
    if(isset($_GET['start_date']) && $_GET['start_date'] != ""){
        $start_date = strtotime($_GET['start_date']);
        $lower = date('Y-m-d', $start_date);
    } else {
        $lower = "";
    }
    if(isset($_GET['end_date']) && $_GET['end_date'] != ""){
        $end_date = strtotime($_GET['end_date']);
        $higher = date('Y-m-d', $end_date);
    } else {
        $higher = "";
    }

    $queryFilter = "";

    if(isset($_GET['filter'])){
        $queryAppend = array();

        if($resourceID != ""){
            array_push($queryAppend, "resource_id = '$resourceID'");
        }
  
        if($keyWord != ""){
            array_push($queryAppend, "(resource_title LIKE '%$keyWord%' OR description LIKE '%$keyWord%' OR tags LIKE '%$keyWord%' OR content LIKE '%$keyWord%')");
        }

        if($category != ""){
            array_push($queryAppend, "resource.category_id LIKE '$category'");
        }

        if($lower != ""){
            array_push($queryAppend, "date_created >= '$lower'");
        }

        if($higher != ""){
            array_push($queryAppend, "date_created <= '$higher'");
        }
    
        foreach($queryAppend as $k => $v) {
            if($k == 0){
                $queryFilter .= " WHERE " . $v;
            } else {
                $queryFilter .= " AND " . $v;
            }
        }
    }
?>

<?php 
  $result = mysqli_query($eduConn, "SELECT * FROM resource INNER JOIN category ON resource.category_id=category.category_id ORDER BY resource.resource_id") or die(mysqli_error($eduConn));
    if(isset($_GET['filter'])){
        $result = mysqli_query($eduConn, "SELECT * FROM resource INNER JOIN category ON resource.category_id=category.category_id $queryFilter ORDER BY resource.resource_id") or die(mysqli_error($eduConn));
    } 

?>


<link rel="stylesheet" href="css/styles.css">
<main>
    <div class="d-flex">
        
        <!--side bar-->
        <?php include ("side_bar.php"); ?>
        <!--contents-->
        <div class="container-fluid p-5 pt-1">
            <!-- header -->
            <div class="mt-3 mb-3">
                <h2>Educational Resources Management</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <a class="link-dark" href="./education.php">Educational Resources List</a>
                    </div>
                    <!-- button for add new jobs -->
                    <div>
                        <a class="btn btn-danger" href="./edu-creator.php">Add New</a>
                        <a class="btn btn-danger" href="./education.php">Refresh</a>
                    </div>
                </div>
                <!-- Search Bar -->
                <hr>
                <div class=" pb-2 pt-2">
                    <form class="row container-fluid d-flex justify-content-center">
                        <div class="row ">
                            <div class="col-sm-3 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Resource ID" name="resource_id"
                                    id="resource_id" <?php if($resourceID != ""){echo "value=\"$resourceID\"";}?>>
                            </div>
                            <div class="col-sm-5 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Key Word" name="key_word"
                                    id="key_word" <?php if($keyWord != ""){echo "value=\"$keyWord\"";}?>>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <select class="form-select" name="category" aria-label="Default select example">
                                    <option value="" <?php if($category == ""){echo "selected=\"selected\"";}?>>Category</option>
                                    <?php
                                        $categoryArray = mysqli_query($eduConn, "SELECT * FROM category") or die(mysqli_error($eduConn));
                                        while($row = mysqli_fetch_array($categoryArray)){
                                            $value = $row['category_id'];
                                            $text = $row['title'];
                                            $optionStatement = "<option value=\"$value\"";
                                            if($category == $value){
                                                $optionStatement .= " selected=\"selected\"";
                                            }
                                            $optionStatement .= " >$text</option>";
                                            echo $optionStatement;
                                        }
                                    ?>
                                
                                </select>
                            </div>
                        </div>
                        <div class="row text-center m-2">
                            <div class="col-sm-1 search-bar-mobile-view">
                                <label class="form-label">From</label>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="date" class="form-control" name="start_date" id="start_date" <?php if($lower != ""){echo "value=\"$start_date\"";}?>>
                            </div>
                            <div class="col-sm-1 search-bar-mobile-view">
                                <label class="form-label">To</label>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="date" class="form-control" name="end_date" id="end_date" <?php if($higher != ""){echo "value=\"$end_date\"";}?>>
                            </div>
                            <div class="desktop-view-button col-sm-2">
                                <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="filter" id="filter">Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- job list -->
                <div>
                    <hr>
                    <div class="card-body list-height d-flex justify-content-between row text-center">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle nowrap">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">Resource ID</th>
                                        <th style="text-align: left;">Title</th>
                                        <th style="text-align: left;">Category</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <th style="text-align: left;"><?php echo $row['resource_id']; ?></th>
                                        <td style="text-align: left;"><?php echo $row['resource_title']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['date_created']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-soft-primary pencil-bg"
                                                href="<?php echo ROOT_URL; ?>/resources/post?id=<?php echo $row['resource_id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a>
                                            <a class="btn btn-sm btn-soft-primary pencil-bg"
                                                href="edu-editor.php?id=<?php echo $row['resource_id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                </svg>
                                            </a>
                                            <a onclick="popupFunction(<?php echo $row['resource_id']; ?>,'education')" class="btn btn-sm btn-soft-danger deleteTrash">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- paginator -->
                        <!-- <div class="d-flex flex-row-reverse">
                            <div class="d-flex flex-column-reverse">
                                <p class="text-muted mb-0">Showing <b>1</b> to <b>12</b> of <b>45</b> entries</p>
                                <div class="col-auto">
                                    <div class="card d-inline-block ms-auto mb-0">
                                        <div class="card-body p-2">
                                            <nav aria-label="Page navigation example" class="mb-0">
                                                <ul class="pagination mb-0">
                                                    <li class="page-item">
                                                        <a class="page-link" href="javascript:void(0);"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true">«</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">1</a></li>
                                                    <li class="page-item active"><a class="page-link"
                                                            href="javascript:void(0);">2</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">3</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">...</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">12</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="javascript:void(0);"
                                                            aria-label="Next">
                                                            <span aria-hidden="true">»</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- delete warning -->
    <div class="deletenotvisible d-flex justify-content-center align-items-center" id="deletepopup">
        <div class="deleteborder">
            <div class="modal-body px-4 py-5 text-center w-auto ">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" onclick="closepopupFunction()"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the educational resource.</p>
                <div class="hstack gap-2 justify-content-center mb-0">
                    <a type="button" class="btn btn-danger" id="deletelink">Delete Now</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closepopupFunction()">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function popupFunction(id,category) {
        document.getElementById("deletepopup").style.visibility = "visible";
        document.getElementById("deletelink").href = "delete.php?id=" + id + "&category=" + category;
    }

    function closepopupFunction() {
        document.getElementById("deletepopup").style.visibility = "hidden"
    }

    // side bar function
    function hide() {
        document.getElementById("try").classList.remove("active-side-bar");
        document.getElementById("showIcon").style.visibility = "visible";
        document.getElementById("showIcon").style.position = "absolute";
        document.getElementById("hamburger-position").style.position = "sticky";

    }

    function show() {
        document.getElementById("try").classList.add("active-side-bar");
        document.getElementById("showIcon").style.visibility = "hidden";
        document.getElementById("showIcon").style.position = "sticky";
        document.getElementById("hamburger-position").style.position = "absolute";
    }
    function screensize() {
        if (x.matches) {
            document.getElementById("try").classList.remove("active-side-bar");
            document.getElementById("showIcon").style.visibility = "visible";
            document.getElementById("showIcon").style.position = "absolute";
            document.getElementById("hamburger-position").style.position = "sticky";
        } else {
            document.getElementById("try").classList.add("active-side-bar");
            document.getElementById("showIcon").style.visibility = "hidden";
            document.getElementById("showIcon").style.position = "sticky";
            document.getElementById("hamburger-position").style.position = "absolute";
        }
    }

    var x = window.matchMedia("(max-width: 1460px)")
    screensize(x) // Call listener function at run time
    x.addListener(screensize) // Attach listener function on state changes
</script>

</body>

</html>

<?php  
    include ("../includes/no_footer.php");
?>