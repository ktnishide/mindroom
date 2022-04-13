<?php

class Routine
{
    public ?int $id;
    public string $name;
    public string $exercise;
    public string $equipment;
    public string $sets;
    public string $reps;

    function fromPost()
    {
        $this->id = isset($_POST['id']) ? $_POST['id'] : null;
        $this->name = isset($_POST['name']) ? $_POST['name'] : '';
        $this->exercise = isset($_POST['exercise']) ? $_POST['exercise'] : '';
        $this->equipment = isset($_POST['equipment']) ? $_POST['equipment'] : '';
        $this->sets = isset($_POST['sets']) ? $_POST['sets'] : '';
        $this->reps = isset($_POST['reps']) ? $_POST['reps'] : '';
        return $this;
    }

    function bindParams($query)
    {
        $query->bindParam(":id",  $this->id);
        $query->bindParam(":name",  $this->name);
        $query->bindParam(":exercise",  $this->exercise);
        $query->bindParam(":equipment",  $this->equipment);
        $query->bindParam(":sets",  $this->sets);
        $query->bindParam(":reps",  $this->reps);
        return $query;
    }

    function update(PDO $dbConnect)
    {
        $sql = "UPDATE `routines` \n"
            . "SET \n"
            . "`name`= :name \n"
            . ",`exercise`= :exercise \n"
            . ",`equipment`= :equipment \n"
            . ",`sets`= :sets \n"
            . ",`reps`= :reps \n"
            . "WHERE id = :id ";
        $query = $dbConnect->prepare($sql);
        $query = $this->bindParams($query);
        $query->execute();
    }

    function insert(PDO $dbConnect)
    {
        $sql = "INSERT INTO `routines`(`id`, `name`, `exercise`, `equipment`, `sets`, `reps`) VALUES (:id , :name , :exercise , :equipment , :sets , :reps )";
        $query = $dbConnect->prepare($sql);
        $query = $this->bindParams($query);
        $query->execute();
    }    
}

include_once('../functions/functions.php');
$dbConnect = dbLink();
if ($dbConnect) {
    echo '<!-- Connection established -->';
}

session_start();

$action = $_GET['type'];
if (isset($_POST['staffName'])) {
    $staffName = $_POST['staffName'];
    actionData($dbConnect, $staffName, $action, 'staff', 'staffName');
}
if (isset($_POST['customerName'])) {
    $customerName = $_POST['customerName'];
    actionData($dbConnect, $customerName, $action, 'customer', 'customerName');
}
if (isset($_POST['className'])) {
    $className = $_POST['className'];
    actionData($dbConnect, $className, $action, 'classes', 'className');
}

if ($action == 'addRoutine') {
    $routine = new Routine();
    $routine->fromPost();
    $routine->insert($dbConnect);
}
if ($action == 'updateRoutine') {
    $routine = new Routine();
    $routine->fromPost();
    $routine->update($dbConnect);
}

if ($action == 'link') {
    if (isset($_GET['staff'])) {
        $table = 'stafftoclass';
        $userld = $_GET['staff'];
    } else {
        $table = 'customertoclass';
        $userld = $_GET['customer'];
    }
    $classid = $_GET['classes'];
    $link = linkTables($dbConnect, $table, $userld, $classid);
}

if ($action == 'linkUserToRoutine') {
    if (isset($_GET['staff'])) {
        $table = 'stafftoroutine';
        $userld = $_GET['staff'];
    } else {
        $table = 'customertoroutine';
        $userld = $_GET['customer'];
    }
    $routineid = $_GET['routines'];
    $link = linkTables($dbConnect, $table, $userld, $routineid);
}

if ($action == 'linkCustomerToStaff') {
    $table = 'customertostaff';
    $userld = $_GET['customer'];
    $staffId = $_GET['staff'];
    $link = linkTables($dbConnect, $table, $userld, $staffId);
}

if ($action == 'book') {
    $table = 'book';
    $uname = $_POST['customerName'];
    $bname = $_POST['bookName'];
    $staffId = $_POST['staff'];
    if (checkName($dbConnect, $uname) == false) {
        insertUser($dbConnect, $uname,  'customer', 'customerName');
    }
    insertUser($dbConnect, $bname,  'book', 'bookName');
    $uid = findcustomerid($dbConnect, $uname);
    linkTables($dbConnect, 'customertostaff', $uid, $staffId);
    $_SESSION['userName'] = $uname;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload="bounce()">

    <script>
        function bounce() {
            window.location.replace("dashboard.php");
        }
    </script>

</body>

</html>