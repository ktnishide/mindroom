<?php
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$n = FALSE;
$p = FALSE;
$successContent = '<div class="logo"></div>
<div class="login-block">
    <h1>Login Sucess! </h1>
    <h1><a href="index.php">[Return to index]</a></h1>
</div>';
$failureContent = '<div class="logo"></div>
<div class="login-block">
    <h1>Login failure =( </h1>
    <h1><a href="index.php">[Return to index]</a></h1>
</div>';

if ($uname == NULL || $pwd == NULL) {
    $body = $failureContent;
}
if (strtolower($uname) != 'scott') {
    // $body = $failureContent;
    $n = FALSE;
} else {
    $n = TRUE;
}
if (strtolower($pwd) != 'x-men') {
    // $body = $failureContent;
    $p = FALSE;
} else {
    $p = TRUE;
}
if (($n == $p) && ($n == TRUE)) {
    $body = $successContent;
} else {
    $body = $failureContent;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<?php echo $body; ?>
<script>
    function bounce() {
        window.location.href = "index.php";
    }
</script>

</body>

</html>