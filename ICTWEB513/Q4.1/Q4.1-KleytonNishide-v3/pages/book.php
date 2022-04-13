<?php
include_once('../functions/functions.php');
$dbConnect = dbLink();
if ($dbConnect) {
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
            <h1>Book a personal trainer</h1>

            <form action="action.php?type=book" method="post">
                <div>
                    <label>Name</label>
                    <input type="text" name="customerName">
                </div>
                <div>
                    <label>More Info</label>
                    <input type="text" name="bookName">
                </div>
                <div>
                    <label>Trainer</label>
                    <?php
                    dropDown($dbConnect, 'staff');
                    ?>
                </div>
                <input type="submit" value="book">
            </form>

        </div>

        <div class="footer"></div>

    </div>
</body>

</html>