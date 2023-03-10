<form method="GET" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="row container-fluid mt-3 d-flex justify-content-center">
<input style="display:none;" type="text" name="id" id="id" value="<?php echo $id ?>">   
<div class="col-sm-3 col-sm-3 search-bar-mobile-view">
        <input type="text" class="form-control" placeholder="Name, Email, or Description" name="applicant-search" id="applicant-search">
    </div>
    <div class="col-sm-2 col-sm-2 search-bar-mobile-view">
        <input type="text" class="form-control" placeholder="Date Apply" onfocus="(this.type='date')" name="date-apply" id="date-apply">
    </div>

    <div class="desktop-view-button col-sm-2 col-sm-2 ">
        <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="find-applicant">Filter
        </button>
    </div>

    </div>
</form>