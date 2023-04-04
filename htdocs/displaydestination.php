<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);

$allDestinations = $manager->getDestinationsForLocation($_GET['location']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookingPage</title>
</head>
<body>
  
<?php foreach ($allDestinations as $destination) : ?>
  <?php
  $tour_operator_id = $destination->getTour_operator_id();
  $tourOperator = $manager-> getTour_operator($tour_operator_id);
  $reviews = $manager->getReviewsForTourOperator($tour_operator_id)
  ?>

  <card> 
    <br>   
    Destination : <?= $destination->getLocation() ?>
    <br>
    Prix : <?= $destination->getPrice() ?>
    <br>
    Tour Opérateur : <?= $tourOperator->getName() ?> <?=$manager->getTourOperatorScore($tour_operator_id) ?>
    <br>
    Avis :
    <ul>
        <?php foreach ($manager->getReviewsForTourOperator($tour_operator_id) as $review) : ?>
          <li><?= $review->getMessage() ?> <i> <?= $review->getAuthor() ?> </i></li>
        <?php endforeach; ?>
      </ul>  
    <br>
  </card>
<?php endforeach; ?>

</body>
</html>


