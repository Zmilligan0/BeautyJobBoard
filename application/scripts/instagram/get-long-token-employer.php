<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../../../config.js"></script>
<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");

$user_id_sql = "SELECT user_id From employer WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$user_id = "";

while ($row = $user_id_list->fetch_assoc())
{ 
    $user_id = $row['user_id']; 
}

// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));

$current_user = mysqli_fetch_array($result);
$instagram_key = $current_user['instagram_key'];
?>
<script>
    getLongToken();
    function getLongToken(accessToken, userID) {
            const client_secret = INSTAGRAM_CLIENT_SECRET;
            const access_token = <?php echo '"'.$instagram_key.'"' ?>;
            const url = "https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret=" + client_secret + "&access_token=" + access_token;
            $.ajax({

                type: "GET",
                url: url,
                success: function(res) {
                    window.location.replace("save-long-token-employer?longToken="+res["access_token"]);
                },
                error: function() {
                    // alert("oops 2");
                }
            })
        };
</script>