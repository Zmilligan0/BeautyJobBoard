<?php
$pageTitle = "Payment";
//$accl = "0,2";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");

// This code gets all the job details and adds to them an array
if (isset($_GET['empId'])) {
    include("includes/receive-questions.php");
    //Array gets parsed and echos out the job details into hidden form inputs
    $job_info_array = array();
    if (count($completeQuestions) > 0) {
        $job_info_array['address'] = $completeQuestions[0]['address'];
        $job_info_array['city'] = $completeQuestions[0]['city'];
        $job_info_array['province'] = $completeQuestions[0]['province'];
        $job_info_array['postal_code'] = $completeQuestions[0]['postal_code'];
        $job_info_array['employ_type'] = $completeQuestions[0]['employ_type'];
        $job_info_array['salary'] = $completeQuestions[0]['salary'];
        $job_info_array['job_description'] = $completeQuestions[0]['job_description'];
        $job_info_array['job_title'] = $completeQuestions[0]['job_title'];
        $job_info_array['employer_id'] = $_GET['empId'];
        $job_info_array['pay_type'] = $completeQuestions[0]['pay_type'];

        foreach ($job_info_array as $key => $value) {
            if ($key != 'job_description') {
                $job_info_array[$key] = stripslashes(stripslashes($value));
            }
            else {
                $job_info_array[$key] = stripslashes($value);
            }
            
        }
    }
}
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    echo "Job ID: " . $job_id;
}

?>



<main class="container">
    <h1>Payment</h1>
    <form action="../scripts/services/payment-script.php" onsubmit="return validateForm()" method="POST" class="form-control p-0">
        <div class="p-2 row">
            <?php
            if (isset($_GET['empId'])) {
                echo '<div>';
                foreach ($job_info_array as $key => $value) {
                    if($key == "job_description"){
                        echo "<input type=\"hidden\" name=\"{$key}\" value='{$value}'> ";
                    }
                    else{
                        echo "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\"> ";
                    }
                    
                }
                echo '</div>';
            }
            if (isset($_GET['job_id'])) {
                echo "<input type='hidden' name='job_id' value='$job_id'>";
            }
            ?>
            <div class="col-lg">
                <label for="basic_choice" class="form-label mt-2">Standard 30 days</label>
                <select name="basic_choice" id="basic_choice" onchange="addToTable()" class="form-select" aria-label="Default select example">
                    <option <?php if (isset($job_id)) {
                                echo 'selected';
                            } ?> value="0">None</option>
                    <option <?php if (!isset($job_id)) {
                                echo 'selected';
                            } ?> value="1">30 days ($8)</option>
                </select>
            </div>
            <div class="col-lg">
                <label for="boost_choice" class="form-label mt-2">Boost your job</label>
                <select onchange="addToTable()" id="boost_choice" name="boost_choice" class="form-select mb-4" aria-label="Default select example">
                    <option selected value="0">None</option>
                    <option value="1">3 day boost ($3)</option>
                    <option value="2">7 day boost ($7)</option>
                    <option value="3">30 day boost ($30)</option>
                </select>
            </div>
        </div>
        <hr class="mb-0">
        <div class="p-2  bg-light">
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Item</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">


                </tbody>
                <tr>
                    <th scope="row">Total:</th>
                    <td></td>
                    <td id="total"></td>
                </tr>
            </table>
        </div>

        <div class="text-lg-end text-center bg-light p-2">
            <button type="submit" name="submit" value="submit" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2">Pay</button>
        </div>
    </form>
</main>
<script>
    let basic_added = false;
    let boost_added = false;
    //function that validates the form
    function validateForm() {
        let basic_choice = document.getElementById("basic_choice").value;
        let boost_choice = document.getElementById("boost_choice").value;
        if (basic_choice == 0 && boost_choice == 0) {
            alert("Please select an option");
            return false;
        } else {
            return true;
        }
    }

    function addToTable() {
        let basic_choice = document.getElementById("basic_choice").value;
        let boost_choice = document.getElementById("boost_choice").value;

        let tableBody = document.getElementById("tableBody");

        // Clear table
        tableBody.innerHTML = "";

        // Add basic choice
        if (basic_choice != 0) {
            let row = tableBody.insertRow();
            let cell1 = row.insertCell();
            let cell2 = row.insertCell();
            let cell3 = row.insertCell();
            cell1.innerHTML = "";
            cell2.innerHTML = "Standard 30 days";
            cell3.innerHTML = "$8";
            basic_added = true;
        } else {
            basic_added = false;
        }

        // Add boost choice
        if (boost_choice != 0) {
            let row = tableBody.insertRow();
            let cell1 = row.insertCell();
            let cell2 = row.insertCell();
            let cell3 = row.insertCell();
            cell1.innerHTML = "";
            if (boost_choice == 1) {
                cell2.innerHTML = "3 day boost";
                cell3.innerHTML = "$3";
            } else if (boost_choice == 2) {
                cell2.innerHTML = "7 day boost";
                cell3.innerHTML = "$7";
            } else if (boost_choice == 3) {
                cell2.innerHTML = "30 day boost";
                cell3.innerHTML = "$30";
            }
            boost_added = true;
        } else {
            boost_added = false;
        }


        total();
    }



    // Calculate total
    function total() {
        let total = 0;
        if (basic_added) {
            total += 8;
        }
        if (boost_added) {
            let boost_choice = document.getElementById("boost_choice").value;
            if (boost_choice == 1) {
                total += 3;
            } else if (boost_choice == 2) {
                total += 7;
            } else if (boost_choice == 3) {
                total += 30;
            }
        }
        document.getElementById("total").innerHTML = "$" + total;
    }
    addToTable();
    total();
</script>
<?php

include("../includes/no_footer.php");
?>