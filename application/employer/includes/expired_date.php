

<?php 
include "../../includes/job_connect.php";

    $list_sql = "SELECT job_id, expiry_date, status From job";
    $list_result = $jobConn->query($list_sql);
    
    while ($row = $list_result->fetch_assoc()){
        $today_date = date("Y-m-d H:m:s");
        $expired_date = $row['expiry_date'];
        echo $row['status'];
        echo '<br>';
        if( $expired_date < $today_date || $expired_date = null )
        {
           "UPDATE job SET status = 0 where expiry_date = $expired_date ";

        }   
        echo $row['status'];
    }   
    


?>
