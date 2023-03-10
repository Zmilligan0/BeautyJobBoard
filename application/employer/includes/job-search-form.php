<div class=" pb-2 pt-2">
<form method="GET" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="row container-fluid d-flex justify-content-center">
    <input style="display:none;" type="text" name="id" id="id" value="<?php echo $id ?>">
    <div class="col-sm-3 col-sm-3 search-bar-mobile-view">
        <input type="text" class="form-control" placeholder="Job title or company" name="job-search" id="job-search">
    </div>

    <div class="col-sm-2 col-sm-2 search-bar-mobile-view">
    <select class="form-select" name="job_types" id="job_types">
        <option selected value="">Job Types</option>
        <option value="0">Full Time</option>
        <option value="1">Part Time</option>
        <option value="2">Contract</option>
        <option value="3">Temporary</option>
        <option value="4">Apprenticeship</option>
      </select>
</div>

<div class="col-sm-2 col-sm-2 search-bar-mobile-view">
    <select class="form-select" name="status-search" id="status-search">    
        <option selected value="1">Active</option>
        <option value="0">Close</option>
      </select>
</div>
<div class="col-sm-2 col-sm-2 search-bar-mobile-view">
    <input type="text" class="form-control" placeholder="Posted Date"  onfocus="(this.type='date')" name="posted_by" id="posted_by">
</div>

<div class="col-sm-2 col-sm-2 search-bar-mobile-view">
    <input type="text" class="form-control" placeholder="Expired Date"  onfocus="(this.type='date')" name="expiry_by" id="expiry_by">
</div>
            <div class="col-sm-4 col-sm-4 search-icon">
                <button class="btn btn-md btn-primary w-100 search-icon " type="submit" name="find-jobs" id="find-jobs"><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px"><path d="M22 20L20 22 14 16 14 14 16 14z"/><path d="M9,16c-3.9,0-7-3.1-7-7c0-3.9,3.1-7,7-7c3.9,0,7,3.1,7,7C16,12.9,12.9,16,9,16z M9,4C6.2,4,4,6.2,4,9c0,2.8,2.2,5,5,5 c2.8,0,5-2.2,5-5C14,6.2,11.8,4,9,4z"/><path d="M13.7 12.5H14.7V16H13.7z" transform="rotate(-44.992 14.25 14.25)"/></svg>
                    </button>
                </div>
            <div class="desktop-view-button col-sm-2 col-sm-2 mt-3">
                <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="find-jobs">Filter
                </button>
            </div>
            </form>
            
