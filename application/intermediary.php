<?php
$pageTitle = "Intermediary";
// $accl = "2,1";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/no_header.php");

$user_id_sql = "SELECT user_id From candidate WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$user_id = "";

while ($row = $user_id_list->fetch_assoc())
{ 
    $user_id = $row['user_id']; 
}

?>
<style>
body
{
    height: 100vh;
}
</style>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <form id="display-instagram" action="" method="POST">
            <input class="btn btn-primary" type="submit" value="Display Instagram">
        </form>
    </div>
</body>

<script src="../config.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var client_id = INSTAGRAM_CLIENT_ID;
    var client_secret = INSTAGRAM_CLIENT_SECRET;
    let displayInstagramButton = document.getElementById("display-instagram");
    const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
    });
    let value = params.code;
            var cmd = 
            {
                client_id: client_id,
                client_secret: client_secret,
                grant_type: "authorization_code",
                redirect_uri: "https://localhost/greenteam2022/application/intermediary",
                code: value,
            };

            $.ajax({
                type: "POST",
                url: "https://aqueous-stream-42053.herokuapp.com/https://api.instagram.com/oauth/access_token",
                data: cmd,
                success: function(newOrder) 
                {

                    displayInstagramButton.action="scripts/instagram/save-token.php?acessToken="+newOrder.access_token+"?instagramID="+newOrder.user_id+"?user_id="+<?php echo $user_id?>;
                    // displayInstagramButton.action="scripts/instagram/save-token.php?acessToken=123?instagramID=123?user_id="+<?php echo $user_id?>;
                    
                },
                error: function() 
                {
                    alert("Instagram failed to load. Please try again.");
                    window.location.href = "scripts/instagram/instagram-error";
                }
            })
</script>