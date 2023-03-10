<?php
try {
    $jobConn = mysqli_connect("db-mysql-tor1-18786-do-user-12947055-0.b.db.ondigitalocean.com:25060", "dev", 'CQ$%QLfnKgjBa%9j', "job_platform");
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage();
    exit;
}
?>