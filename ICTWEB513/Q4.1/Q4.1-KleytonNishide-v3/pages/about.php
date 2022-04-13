<?php
include_once('../functions/functions.php');
$dbConnect = dbLink();
if($dbConnect){
    echo '<!-- Connection esablished -->';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h1>Welcome to Xaviers Gym</h1>
        </div>
        <div class="nav">
        <a href="../index.php"> [ Home ]</a>
            <form action="dashboard.php" method="post">
                <input type="text" name="userName" placeholder="Enter Name">
                <input type="submit" value="Login">
            </form>
        </div>
        <div class="cta">
            <h1>About</h1>
            <p>
                dolor sit amet, consectetur adipisicing elit. Ex atque numquam ipsa aliquam ducimus quas obcaecati illum. Quibusdam esse earum eaque error sequi. Vitae exercitationem recusandae iure, cum quas temporibus!
            </p>
        </div>
        
        <div class="footer"></div>

    </div>
</body>

</html>