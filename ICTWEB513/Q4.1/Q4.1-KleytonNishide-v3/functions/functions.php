<?php
function dbLink()
{
    $dbUser = 'charlesx';
    $dbPass = 'password';
    $dbHost = 'localhost';
    $db = 'xavierGym';

    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$db;", $dbUser, $dbPass);
    } catch (Exception $e) {
        echo 'Unable to connect';
        exit;
    }

    error_reporting(0);
    return $db;
}

function showMem()
{
    echo '<pre>';
    echo 'Post ';
    print_r($_POST);
    echo '</pre>';
    echo '<br>';
    echo '<pre>';
    echo 'Sesion ';
    print_r($_SESSION);
    echo '</pre>';
}

function checkName($dbConnect, $uname)
{
    $sql = 'SELECT * FROM staff';
    foreach ($dbConnect->query($sql) as $row) {
        if ($uname == $row['staffName']) {
            return 'staff';
        }
    }
    $sql = 'SELECT * FROM customer';
    foreach ($dbConnect->query($sql) as $row) {
        if ($uname == $row['customerName']) {
            return 'customer';
        }
    }
    return false;
}


function addStaff($dbConnect)
{
    echo '
    <form action="../pages/action.php?type=add" method="post"> 
        <input type="text" name="staffName" placeholder="Enter Staff Name">
        <input type="submit" value="Add staff">
        </form>';
}
function addCustomers($dbConnect)
{
    echo '
    <form action="../pages/action.php?type=add" method="post"> 
        <input type="text" name="customerName" placeholder="Enter Customer Name">
        <input type="submit" value="Add customer">
        </form>';
}
function addClass($dbConnect)
{
    echo '
    <form action="../pages/action.php?type=add" method="post"> 
        <input type="text" name="className" placeholder="Enter class Name">
        <input type="submit" value="Add class">
        </form>';
}
function addRoutine($dbConnect)
{
    echo '
    <form action="../pages/action.php?type=addRoutine" method="post"> 
        <input type="text" name="name" placeholder="Enter routine Name">
        <input type="text" name="exercise" placeholder="Enter exercise">
        <input type="text" name="equipment" placeholder="Enter equipment">
        <input type="text" name="sets" placeholder="Enter sets">
        <input type="text" name="reps" placeholder="Enter reps">
        <input type="submit" value="Add routine">
        </form>';
}

function actionData($dbConnect, $details, $action, $table, $field)
{
    switch ($action) {
        case 'add': {
                $result = insertUser($dbConnect, $details, $table, $field);
            }
            break;
    }
}

function insertUser($dbConnect, $details, $table, $field)
{
    $q = "INSERT into $table (id,$field) VALUES(NULL,:details);";
    $query = $dbConnect->prepare($q);
    $query->bindParam(":details", $details);
    $result = $query->execute();
    return $result;
}


function viewAll($dbConnect)
{
    listDetails($dbConnect, 'staff');
    listDetails($dbConnect, 'customer');
    listDetails($dbConnect, 'classes');
    echo '<div style="clear:both;"></div>';
}

function listDetails($dbConnect, $table)
{
    switch ($table) {
        case 'staff':
            $field = 'staffName';
            break;
        case 'customer':
            $field =  'customerName';
            break;
        case 'classes':
            $field = 'className';
            break;
    }

    echo '<div class="ctaBox">';
    echo '<h3>' . ucfirst($table) . '</h3>';
    $sql = "SELECT * FROM $table";
    foreach ($dbConnect->query($sql) as $row) {
        echo $row[$field] . '<br>';
    }
    echo '</div>';
}

function userToClass($dbConnect, $tb1, $tb2)
{
    echo '<form action="action.php" method="GET">';
    dropDown($dbConnect, $tb1);
    dropDown($dbConnect, $tb2);
    echo '<input type="hidden" name="type" value="link">';
    echo '<input type="submit" value="Link">';
    echo '</form>';
}

function userToRoutine($dbConnect, $tb1, $tb2)
{
    echo '<form action="action.php" method="GET">';
    dropDown($dbConnect, $tb1);
    dropDown($dbConnect, $tb2);
    echo '<input type="hidden" name="type" value="linkUserToRoutine">';
    echo '<input type="submit" value="Link">';
    echo '</form>';
}

function userToStaff($dbConnect, $acct)
{
    echo '<form action="action.php" method="GET">';
    dropDown($dbConnect, 'customer');
    dropDown($dbConnect, 'staff');
    echo '<input type="hidden" name="type" value="linkCustomerToStaff">';
    echo '<input type="submit" value="Link">';
    echo '</form>';
}

function dropDown($dbConnect, $table)
{
    switch ($table) {
        case 'staff':
            $field = 'staffName';
            break;
        case 'customer':
            $field = 'customerName';
            break;
        case 'classes':
            $field = 'className';
            break;
        case 'routines':
            $field = 'name';
            break;
    }
    $sql = "SELECT * FROM $table";
    echo '<select name="' . $table . '">';
    foreach ($dbConnect->query($sql) as $row) {
        echo '<option name="' . $table . '" value="' . $row['id'] . '">' . $row[$field] . '</ option>';
    }
    echo '</select>';
}


function linkTables($dbConnect, $table, $userId, $classid)
{

    switch ($table) {
        case 'stafftoclass':
            $field1 = 'staffId';
            $field2 = 'classId';
            break;
        case 'customertoclass':
            $field1 = 'customerId';
            $field2 = 'classId';
            break;
        case 'customertostaff':
            $field1 = 'customerId';
            $field2 = 'staffId';
            break;
        case 'stafftoroutine':
            $field1 = 'staffId';
            $field2 = 'routineId';
            break;
        case 'customertoroutine':
            $field1 = 'customerId';
            $field2 = 'routineId';
            break;

        default:
            echo 'oh no!';
            return;
    }

    $q = "INSERT into $table (id,$field1,$field2) VALUES(NULL,:user,:class);";
    $query = $dbConnect->prepare($q);
    $query->bindParam(":user", $userId);
    $query->bindParam(":class", $classid);
    $result =  $query->execute();
    return $result;
}

function viewLinked($dbConnect)
{
    echo '<h3>Staff teaching class</h3>';
    staffToClass($dbConnect);
    echo '<h3>Customer attending class</h3>';
    customerToClass($dbConnect);
}


function staffToClass($dbConnect)
{
    $table = 'stafftoclass';
    $sql = "SELECT * FROM $table";
    foreach ($dbConnect->query($sql) as $row) {
        $staffid = $row['staffId'];
        $classid = $row['classId'];
        $sqlstaff = "SELECT DISTINCT staffName from staff WHERE id = $staffid";
        foreach ($dbConnect->query($sqlstaff) as $rowstaff) {
            echo $rowstaff['staffName'];
        }
        echo ' :: ';
        $sqlclass = "SELECT DISTINCT className from classes WHERE id = $classid";
        foreach ($dbConnect->query($sqlclass) as $rowclass) {
            echo $rowclass['className'];
        }
        echo '<br>';
    }
}

function customerToClass($dbConnect)
{
    $table = 'customertoclass';
    $sql = "SELECT * FROM $table";
    foreach ($dbConnect->query($sql) as $row) {
        $customerid = $row['customerId'];
        $classid = $row['classId'];
        $sqlcustomer = "SELECT DISTINCT customerName from customer WHERE id = $customerid";
        foreach ($dbConnect->query($sqlcustomer) as $rowcustomer) {
            echo $rowcustomer['customerName'];
        }
        echo ' :: ';
        $sqlclass = "SELECT DISTINCT className from classes WHERE id = $classid";
        foreach ($dbConnect->query($sqlclass) as $rowclass) {
            echo $rowclass['className'];
        }
        echo '<br,';
    }
}


function classesBeingTaught($dbConnect, $uname)
{
    $staffid = findStaffId($dbConnect, $uname);
    listCBTaught($dbConnect, $staffid);
}

function findStaffId($dbConnect, $detail)
{
    $sqlstaff = "SELECT * from staff";
    foreach ($dbConnect->query($sqlstaff) as $rowstaff) {
        if ($detail == $rowstaff['staffName']) {
            return $rowstaff['id'];
        }
    }
}

function listCBTaught($dbConnect, $staffid)
{
    $sql = "SELECT * from stafftoclass";
    foreach ($dbConnect->query($sql) as $row) {
        if ($row['staffId'] == $staffid) {
            $cId = $row['classId'];
            $cName = findClassName($dbConnect, $cId);
            echo '<br><b>Class: ' . ucfirst($cName) . '</b>';
            customerPerClass($dbConnect, $cId);
        }
    }
}

function findClassName($dbConnect, $detail)
{
    $sql = "SELECT * from classes";
    foreach ($dbConnect->query($sql) as $rowclass) {
        if ($detail == $rowclass['id']) {
            return $rowclass['className'];
        }
    }
}

function customerPerClass($dbConnect, $classId)
{
    $sql = "SELECT * from customertoclass";
    foreach ($dbConnect->query($sql) as $row) {
        if ($row['classId'] == $classId) {
            $customerId = $row['customerId'];
            $customer = findCustomerName($dbConnect, $customerId);
            echo '<br>' . $customer;
        }
    }
}

function findCustomerName($dbConnect, $detail)
{
    $sql = "SELECT * from customer";
    foreach ($dbConnect->query($sql) as $row) {
        if ($detail == $row['id']) {
            return $row['customerName'];
        }
    }
}


function classesAttending($dbConnect, $uname)
{
    $sid = findcustomerid($dbConnect, $uname);
    echo '<h2>Scheduled classes:</h2>';
    $sql = "SELECT * from customertoclass";
    foreach ($dbConnect->query($sql) as $row) {
        if ($row['customerId'] == $sid) {
            $cid = $row['classId'];
            $cName = findClassName($dbConnect, $cid);
            echo '<br><b>' . ucfirst($cName) . '</b>';
        }
    }
}

function findcustomerid($dbConnect, $detail)
{
    $sql = "SELECT * from customer";
    foreach ($dbConnect->query($sql) as $row) {
        if ($detail == $row['customerName']) {
            return $row['id'];
        }
    }
}

function viewAllClasses($dbConnect)
{
    listDetails($dbConnect, 'classes');
    echo '<div style="clear:both;"></div>';
}


function myTrainers($dbConnect, $uname)
{
    $sql = "SELECT *\n"
        . "FROM `customerToStaff` a  \n"
        . "INNER JOIN customer b on a.customerId = b.id\n"
        . "INNER JOIN staff c  on a.staffId = c.id \n"
        . "WHERE b.customerName = :uname ";
    $query = $dbConnect->prepare($sql);
    $query->bindValue(":uname", $uname, PDO::PARAM_STR);
    $query->execute();
    while ($row = $query->fetch()) {
        echo $row['staffName'];
        echo '<br>';
    }
}


function grabRoutinesToEdit($dbConnect)
{
    $sql = "SELECT * FROM routines";
    echo '
    <table class="demo">
    <caption>Update routines</caption>
    <thead>
    <tr>
        <th>name</th>
        <th>exercise</th>
        <th>equipment</th>
        <th>sets</th>
        <th>reps</th>
        <th></th>
    </tr>
    </thead>
    <tbody>';

    foreach ($dbConnect->query($sql) as $row) {
        echo '
        <tr><form action="../pages/action.php?type=updateRoutine" method="post">
        <td><input type="text" name="name" value="' . $row['name'] . '"></td>
        <td><input type="text" name="exercise" value="' . $row['exercise'] . '"></td>
        <td><input type="text" name="equipment" value="' . $row['equipment'] . '"></td>
        <td><input type="text" name="sets" value="' . $row['sets'] . '"></td>
        <td><input type="text" name="reps" value="' . $row['reps'] . '"></td>
        <td><input type="hidden" name="id" value="' . $row['id'] . '"><input type="submit" value="Edit"></td>
    </form></tr>';
    }
    echo '
    </tbody>
    </table>';
}

function grabRoutinesToRead(PDO $dbConnect, $uname)
{
    $uid = findcustomerid($dbConnect, $uname);

    $sql = "SELECT * FROM `routines` a \n"
    . "LEFT JOIN customerToRoutine b \n"
    . "on a.id = b.routineId\n"
    . "WHERE b.customerId = :id ";

    $query = $dbConnect->prepare($sql);
    $query->bindParam(":id", $uid);
    $query->execute();

    echo '
    <table class="demo">
    <h2>Your personalised routines</h2>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>exercise</th>
        <th>equipment</th>
        <th>sets</th>
        <th>reps</th>
    </tr>
    </thead>
    <tbody>';

    while ($row = $query->fetch()) {
        echo '
        <tr>
        <td><input readonly="readonly" type="text" name="id" value="' . $row['id'] . '"></td>
        <td><input readonly="readonly" type="text" name="name" value="' . $row['name'] . '"></td>
        <td><input readonly="readonly" type="text" name="exercise" value="' . $row['exercise'] . '"></td>
        <td><input readonly="readonly" type="text" name="equipment" value="' . $row['equipment'] . '"></td>
        <td><input readonly="readonly" type="text" name="sets" value="' . $row['sets'] . '"></td>
        <td><input readonly="readonly" type="text" name="reps" value="' . $row['reps'] . '"></td>
    </tr>';
    }
    echo '
    </tbody>
    </table>';
}


