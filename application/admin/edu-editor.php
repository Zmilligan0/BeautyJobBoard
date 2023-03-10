<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">

<?php
    $accl = "0,0";
    $pageTitle = "Edit Educational Resource";
    include("../includes/edu_connect.php");
    include("../includes/utils.php");
    include("../includes/header.php");
?>

<?php
// Get all the categories from category table

$resourceID = $_GET['id']; 
if(!isset($resourceID)){
    // this value MUST be set in order for the next query to work
    //$charID =  1;// if not, load the first (assuming it's 1);
    $result = mysqli_query($eduConn,"SELECT * FROM resource LIMIT 1") or die (mysqli_error($eduConn));
    
    while($row = mysqli_fetch_array($result)){
        $resourceID = $row['resource_id'];
    }
}

$result = mysqli_query($eduConn,"SELECT * FROM resource WHERE resource_id=$resourceID") or die (mysqli_error($eduConn));
while($row = mysqli_fetch_array($result)){
    $currentTitle = $row['resource_title'];
    $currentDescription = $row['description'];
    $currentTags = $row['tags'];
    $currentContent = $row['content'];
    $currentDate = date('Y-m-d', strtotime($row['date_created']));
    $currentCategoryID = $row['category_id'];
    if($row['tags'] != ""){
        $currentTags = explode(",", $row['tags']);
    } else {
        $currentTags = "";
    }

}



$sql = "SELECT * FROM `category`";
$all_categories = mysqli_query($eduConn, $sql);
?>

<main>
    <div class="d-flex">

        <!--side bar-->
        <?php include("side_bar.php"); ?>
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
                        <a class="link-dark" href="./education.php">Education Resource List</a>
                        <p>&nbsp;>>&nbsp;</p>
                        <p>Update Resource ID: <?php echo $resourceID; ?></p>
                    </div>
                    <!-- button for add new jobs -->

                </div>
            </div>
            <hr>
            <div class=" p-3 container p-5 pt-1">
                <h1 hidden class="text-decoration-underline">New Education Resource</h1>

                <form class="form" name="myForm" method="post" action="edu-editor-script.php?id=<?php echo $resourceID; ?>" onsubmit="return validateForm()">
                    <!-- Hidden input to attach quill delta value to -->
                    <input hidden id="edu-content" name="edu-content">
                    <input hidden id="edu-tags" name="edu-tags">
                    <!-- Form inputs -->
                    <label for="title" class="fw-bold mt-2 form-label">*Title</label>
                    <input type="text" id="title" class="form-control" name="title" placeholder="Title" value="<?php echo $currentTitle ?>">
                    <small hidden id="title_err" class="ms-2"></small>

                    <div class="row">

                        <div class="col-12 col-md">
                            <label for="date-selection" class="fw-bold mt-2 form-label">*Date created</label>
                            <input type="date" class="form-control" id="date-selection" name="date-selection" class="d-block" min="2001-01-01" value=<?php echo $currentDate; ?>>
                            <small hidden id="date_err" class="ms-2"></small>
                        </div>
                        <div class="col-12 col-md">
                            <!-- Query all the categories and put it into a selection list -->
                            <label for="category" class="fw-bold mt-2 form-label">*Category</label>
                            <select name="category" class="form-select">
                                <option value="0">Please select a Category</option>
                                <?php
                                // use a while loop to fetch data
                                // from the $all_categories variable
                                // and individually display as an option
                                while ($category = mysqli_fetch_array(
                                    $all_categories,
                                    MYSQLI_ASSOC
                                )) :;
                                ?>
                                    <option value="<?php echo $category["category_id"];
                                                    // The value we usually set is the primary key
                                                    ?>" <?php if($category['category_id'] == $currentCategoryID){ echo "selected"; } ?>>
                                        <?php echo $category["title"];
                                        // To show the category name to the user
                                        ?>
                                    </option>
                                <?php
                                endwhile;
                                // While loop must be terminated
                                ?>
                            </select>
                            <small hidden id="category_err" class="ms-2"></small>
                        </div>

                    </div>


                    <label for="description" class="fw-bold mt-2 form-label">*Description</label>
                    <textarea class="form-control" name="description" style="min-height: 10rem;max-height: 10rem;"><?php echo $currentDescription; ?></textarea>
                    <small hidden id="description_err" class="ms-2"></small>

                    <label class="fw-bold mt-2 mb-2 form-label">*Content</label>
                    <!-- Create the editor container -->
                    <div style="height: 200px;" id="edu-main">
                        <p>content goes here</p>
                    </div>

                    <!-- Tag adding section -->
                    <div>
                        <label class="fw-bold mt-2 mb-2 form-label">*Tags</label>
                        <div class="bg-light p-3" style="border: 1px solid #ced4da">
                            <div>
                                <ul class="row justify-content-md-center" id="tag-list" style="list-style: none; padding-left: 0;">
                                    <?php foreach($currentTags as $value): ?>
                                    <li class="bg-opacity-50 bg-primary px-1 m-1 pe-1 rounded col-auto"><?php echo $value; ?><a onclick="removeTag(this)"><svg class="ms-1 mb-1" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" /></svg></a></li>
                                    <?php endforeach; ?>
                                </ul>
                                <p hidden id="currentcount"><?php echo count($currentTags); ?></p>
                            </div>
                            <div class="input-group mt-3">
                                <input type="text" id="tags" class="form-control" placeholder="Enter a tag">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" onclick='addTag()' value="Submit" id="tagAdd" style="border-radius: 0 0.375rem 0.375rem 0;" type="button">Add</button>
                                </div>
                            </div>
                        </div>
                        <small hidden id="tags_err" class="ms-2"></small>
                    </div>


                    <div class="mb-2 mt-2 text-lg-end text-center">
                        <input type="submit" name="submit" value="Save" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<script>
    function popupFunction() {
        document.getElementById("deletepopup").style.visibility = "visible"
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

    // Code enables "enter" key to save a tag
    var tagInput = document.getElementById("tags");
    // Execute a function when the user presses a key on the keyboard
    tagInput.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("tagAdd").click();
        }
    });

    // QuillJS toolbar
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote'],

        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],

        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'align': []
        }],

        ['link', 'image', 'video'],

        [{
            'font': []
        }],
        [{
            'size': ['small', false, 'large', 'huge']
        }],
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
    ];

    //Init QuillJS editor
    var quill = new Quill('#edu-main', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });

    quill.setContents(<?php if(isset($currentContent)) {echo stripslashes($currentContent);} ?>);

    // Variables for tags
    var list = document.getElementById('tag-list');
    let tagList = [];
    let tagCount = document.getElementById('currentcount').innerHTML;

    //This function adds the typed tag to an array and to the DOM
    function addTag() {
        var tags = document.getElementById('tags').value;
        // Doesn't add a tag if a tag isn't typed
        if (tags === "") {
            return false;
        }
        // Doesn't add a tag if only spaces are typed
        if (!tags.replace(/\s/g, '').length) {
            return false;
        }
        //create li element
        var entry = document.createElement('li');
        //set li element value 

        //Add bootstrap classes
        entry.className = "bg-opacity-50 bg-primary px-1 m-1 pe-1 rounded col-auto"
        //Set innerHtml
        entry.innerHTML = `${tags}<a onclick="removeTag(this)"><svg class="ms-1 mb-1" xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" /></svg></a>`

        //Add to dom
        list.appendChild(entry);
        //reset input field to blank
        document.getElementById('tags').value = "";
        //add entered tag to array
        tagList.push(tags);
        entry.value = tagCount;
        tagCount++;
    }

    function arrayToCsv() {
        return tagList.join(',');
    }

    function removeTag(el) {
        var element = el;
        let index = element.parentElement.value;
        console.log(index);
        tagList[index] = "DEL";
        element.parentElement.remove();
    }

    //Get html elements to add errors to

    let isError = false;

    //Function hides error messages when a 2nd arguement isnt provided. Otherwise it shows
    //Returns true when a message is provided
    function toggleError(htmlID, message) {
        let err = document.getElementById(htmlID);
        if (message === undefined) {
            err.innerHTML = message;
            err.hidden = true;
        } else {
            err.style.color = 'red';
            err.innerHTML = message;
            err.hidden = false;
            return true;
        }
    }


    function saveQuill() {
        document.getElementById('edu-content').value = JSON.stringify(quill.getContents());
    }

    function validateForm() {
        isError = false;
        let errorList = [];
        let tags = document.forms["myForm"]["edu-tags"].value = arrayToCsv();
        console.log(tags)
        let title = document.forms["myForm"]["title"].value;
        let date = document.forms["myForm"]["date-selection"].value;
        let category = document.forms["myForm"]["category"].value;
        let description = document.forms["myForm"]["description"].value;

        //Checking for blanks
        if (title === "") {
            isError = toggleError('title_err', 'Title is blank');
        } else {
            toggleError('title_err');
        }
        if (date === "") {
            isError = toggleError('date_err', 'Date is not selected');
        } else {
            toggleError('date_err');
        }
        if (category === "0") {
            isError = toggleError('category_err', 'Must select a Category');
        } else {
            toggleError('category_err');
        }
        if (description === "") {
            isError = toggleError('description_err', 'Description is blank');
        } else {
            toggleError('description_err');
        }
        //Bug: If user adds a tag then deletes all the tags. No error is shown
        if (tags.length <= 0) {
            isError = toggleError('tags_err', 'Please enter atleast 1 tag');
        } else {
            toggleError('tags_err');
        }
        //Return false if there's an error
        if (isError) {
            // Return false, validation failed
            return false;
        } else {
            //Return true if validation succeeds
            saveQuill();
            return true;
        }
    }
</script>

<?php
    include("../includes/no_footer.php");
?>