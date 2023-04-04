<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);

//redirection de /admin vers ./admin.php
if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false) {
  header('Location: admin.php');
  exit();
}

$allLocations = $manager->getAllLocations();

require_once("./partials/locationsForm.php");

?>