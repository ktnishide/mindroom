<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <?php
  
  echo '<h1> Kleyton Nishide </h1>';
  
  session_start();
  $usid = session_id();
  echo '<br>' . $usid;
  
  $_SESSION['MindRoom'] = 'This is my assignment';
  echo '<br>' . $_SESSION['MindRoom'];


  ?>
</body>

</html>