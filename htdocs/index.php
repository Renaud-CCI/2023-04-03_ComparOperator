<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);
$allLocations = $manager->getAllLocations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ComparOperator</title>
</head>
<body>
  
<?php require_once('./partials/locationsForm.php') ?>

</body>
</html>