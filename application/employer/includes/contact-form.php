<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="POST" enctype="multipart/form-data">
<?php 
    if (isset($validation)): ?>
    <div class="validation">
        <?php echo $validation; ?> 
    </div>
    <?php endif ?>
                <label for="first_name" class="fw-bold mt-2 form-label">First Name</label>
                <input type="text" id="first_name" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo $first_name?>">
    
                <label for="last_name" class="fw-bold mt-2 form-label">Last Name</label>
                <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Enter Last Name"  value="<?php echo $last_name?>">
    
                <label for="email" class="fw-bold mt-2 mb-0 form-label">E-mail</label>
                <!-- <small class="d-block mb-2 fw-light">Enter the street address for better visibility</small> -->
                <input type="text" id="email" class="form-control" name="email" placeholder="Enter E-mail" value="<?php echo $email?>">
                <label for="position" class="fw-bold mt-2 form-label">Notes</label>
                <input type="text" id="position" class="form-control" name="position" placeholder="Enter Position"  value="<?php echo $position?>">
               
                <div class="mb-3 text-lg-end text-center">
                    <button type="submit" name="new-contact" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2">Submit</button>
                </div> 
    
    
    
            </form>