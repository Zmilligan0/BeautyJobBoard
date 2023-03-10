<?php
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$user_id = $exploded_url_query[1];

?>

<?php if ($hide_me == false) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" onsubmit="saveQuill()" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($validation)) : ?>
        <div class="validation">
            <?php echo $validation; ?>
        </div>
    <?php endif ?>
    <?php
    if (isset($_POST['next'])) {
        $hide = "style=\"display: none;\"";
    } else {
        $hide = "";
    }
    $expiry_date = ""

    ?>

        <label for="job_title" class="fw-bold mt-2 form-label">Job Title</label>
        <input type="text" id="job_title" class="form-control" name="job_title" placeholder="Enter Job Title" value="<?php echo $job_title ?>">

        <label for="address" class="fw-bold mt-2 form-label">Address</label>
        <input type="text" id="address" class="form-control" name="address" placeholder="Enter address" value="<?php echo $job_address ?>">

        <label for="city" class="fw-bold mt-2 mb-0 form-label">City</label>
        <input type="text" id="city" class="form-control" name="city" placeholder="Enter City" value="<?php echo $city ?>">
        <label for="province" class="fw-bold mt-2 form-label">Province</label>
        <input type="text" id="province" class="form-control" name="province" placeholder="AB" pattern="[A-Za-z][A-Za-z]" value="<?php echo $province ?>">
        <label for="postal_code" class="fw-bold mt-2 form-label">Postal Code</label>
        <input type="text" id="postal_code" class="form-control" pattern="[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]" name="postal_code" placeholder="e.g. A1A 1A1" value="<?php echo $postal_code ?>">

        <?php $expiry_date_new = Date('Y-m-d H:m:s', strtotime('+30 days')); ?>
    
        <label for="expiry_date" class="fw-bold mt-2 form-label">Expired Date</label>
        <input type="text" class="form-control" placeholder="Expired Date" onfocus="(this.type='date')" id="expiry_date" name="expiry_date" 
        value="<?php if ($expiry_date = $expiry_date){
            echo date("M d, Y", strtotime($expiry_date));
            // echo $expiry_date;
        } else {
            echo date("M d, Y", strtotime($expiry_date_new));
            // echo $expiry_date_new;
        } 
        ?>"  disabled>

        <label for="employ_type" class="fw-bold mt-2 mb-0 form-label">*Employment Type</label>
        <select class="form-select mt-2 mb-4" id="employ_type" name="employ_type" value="<?php echo $employment_type ?>">
            <option selected value="0">Full Time</option>
            <option value="1">Part Time</option>
            <option value="2">Contract</option>
            <option value="3">Temporary</option>
            <option value="4">Apprenticeship</option>
        </select>

        <div>
            <label class="fw-bold mt-2 mb-2 form-label">Compensation</label>
            <div class="bg-light flex-row d-lg-flex p-3" style="border: 1px solid #ced4da">
                <input class=" col-12 col-lg-4 d-block d-lg-inline" type="number" min="0.00" placeholder="$CAD" id="salary" name="salary" value="<?php echo $salary ?>">

                <select class="col-lg-2 col-8 ms-lg-1 mt-2 mt-lg-0 " id="pay_type" name="pay_type" value="<?php echo $payment_type ?>">
                    <option selected value="Annually">Annually</option>
                    <option value="Hourly">Hourly</option>
                    <option value="Salary">Salary</option>
                </select>
            </div>
        </div>

        <label class="fw-bold mt-2 mb-2 form-label">Job description</label>
        <input hidden id="description" name="description" value=""></input>
        <!-- Create the editor container -->
        <div style="height: 200px;" id="job_description">

        </div>

        <!-- Initialize Quill editor -->
        <script>
            var quill = new Quill('#job_description', {
                theme: 'snow'
            });

            function saveQuill() {

                document.getElementById('description').value = JSON.stringify(quill.getContents());
                console.log(document.getElementById('description').value);
            }
            // Sets content to job_description. If new post just sets it to blank. 
            quill.setContents(<?php echo stripslashes($job_description) ?>);
        </script>

        <div class="mb-3 text-lg-end text-center">
            <button type="submit" name="new-job-post" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2">Submit</button>
        </div>


</form>

<?php endif ?>
