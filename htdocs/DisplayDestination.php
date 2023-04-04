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
  <link rel="stylesheet" href="./css/bootstrap.css">
  <title>BookingPage</title>
</head>

<body>
  <div class="d-flex justify-content-center m-5">
    <h1 class="text-sandyellow"> Voyages vers <?= $_GET['location'] ?>:</h1>
  </div>

  <?php foreach ($allDestinations as $destination) : ?>
    <?php
    $tour_operator_id = $destination->getTour_operator_id();
    $tourOperator = $manager->getTour_operator($tour_operator_id);
    $reviews = $manager->getReviewsForTourOperator($tour_operator_id)
    ?>

    <div class="containerDestination overflow-hidden">
      <div class="screen">
        <div class="screen__content p-5 mt-5 mb-5 text-sandyellow">


          <h4>
            Prix : <?= $destination->getPrice() ?>
          </h4>

          <h4>
            Tour Opérateur : <?= $tourOperator->getName() ?> <?= $manager->getTourOperatorScore($tour_operator_id) ?>
          </h4>


        </div>
        <div class="screen__background">
          <span class="screen__background__shape screen__background__shape4"></span>
          <span class="screen__background__shape screen__background__shape3"></span>
          <span class="screen__background__shape screen__background__shape2"></span>
          <span class="screen__background__shape screen__background__shape1"></span>
        </div>
      </div>


    </div>
    <div class="d-flex justify-content-center align-content-center text-align-center">

      <article class="leaderboard">
        <header>

          <h1 class="leaderboard__title"><span class="leaderboard__title--top">Review</span><span class="leaderboard__title--bottom">Clients</span></h1>
        </header>

        <?php foreach ($manager->getReviewsForTourOperator($tour_operator_id) as $review) : ?>
          <main class="leaderboard__profiles">
            <article class="leaderboard__profile">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mark Zuckerberg" class="leaderboard__picture">
              <span class="leaderboard__name"><?= $review->getMessage() ?></span>
              <span class="leaderboard__value"><span></span><?= $review->getAuthor() ?></span>
            </article>

          </main>
        <?php endforeach; ?>
      </article>
    </div>

  <?php endforeach; ?>

</body>

</html>