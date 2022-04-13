<?php
include_once('../functions/functions.php');
$dbConnect = dbLink();
if ($dbConnect) {
    echo '<!-- Connection esablished -->';
}
session_start();

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
            <h2>Dashboard</h2>
            <a href="logout.php"> [ Logout ]</a>
        </div>
        <div class="cta">
            <div class="content">
                <?php
                $uname = $_SESSION['userName'];
                if (!$uname) {
                    $uname = $_POST['userName'];
                    $_SESSION['userName'] = $uname;
                }

                $accountType = checkName($dbConnect, $uname);
                if ($uname == 'admin' &&  $accountType == 'staff') {
                    echo '<h2>Admin account - Welcome ' . $uname . '</h2><br>';
                    // add staff fields
                    addStaff($dbConnect);
                    echo '<br>';
                    // add customer fields
                    addCustomers($dbConnect);
                    echo '<br>';
                    // add classes fields
                    addClass($dbConnect);
                    echo '<br>';
                    // Boxes with all data
                    viewAll($dbConnect);
                    echo '<br>Staff to Class<br>';
                    userToClass($dbConnect, 'staff', 'classes');
                    echo '<br>Customer to Class<br>';
                    userToClass($dbConnect, 'customer', 'classes');
                    echo '<br>';
                    viewLinked($dbConnect);
                } else
                if ($accountType == 'staff') {
                    echo '<h2>Staff account - Welcome ' . ucfirst($uname) . '</h2><br>';
                    // add classes fields
                    echo '<h2>Create classes</h2>';
                    addClass($dbConnect);
                    echo '<h2>Link Staff to Class<br></h2>';
                    userToClass($dbConnect, 'staff', 'classes');
                    echo '<h2>Link Customer to Class<br></h2>';
                    userToClass($dbConnect, 'customer', 'classes');
                    // add routine fields
                    echo '<h2>Create routine<br></h2>';
                    addRoutine($dbConnect);
                    echo '<h2>Link Customer to routine<br></h2>';
                    userToRoutine($dbConnect, 'customer', 'routines');
                    echo '<h2>Link Staff to routine<br></h2>';
                    userToRoutine($dbConnect, 'staff', 'routines');
                    echo '<br>';                    
                    grabRoutinesToEdit($dbConnect);
                    //
                    echo '<h2>Your classes:<br></h2>';
                    classesBeingTaught($dbConnect, $uname);
                } else if ($accountType == 'customer') {
                    echo '<h2>Customer account - Welcome ' . ucfirst($uname) . '</h2>';
                    classesAttending($dbConnect, $uname);
                    echo '<h2>Your booked trainers:</h2>';
                    myTrainers($dbConnect, $uname);
                    grabRoutinesToRead($dbConnect, $uname);
                } else {
                    echo '<h2>Invalid Account</h2>';
                }
                ?>
            </div>
        </div>
        <!-- <div class="footer"></div> -->
    </div>
</body>

</html>