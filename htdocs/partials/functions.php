<?php


//Fonction pour rajouter des étoiles en fonction de la note
function ranking(float $note){
  $fullStar = "<i class='fa-solid fa-star' style='color: #d6a800;'></i>";
  $halfStar = "<i class='fa-regular fa-star-half-stroke' style='color: #d6a800;'></i>";
  $emptyStar = "<i class='fa-regular fa-star' style='color: #d6a800;'></i>";

  $return = '';

  for ($i=1; $i<=5 ; $i++){
    if ($i <= $note){
      $return .= $fullStar;
    } elseif ($i-$note <1){
      $return .= $halfStar;
    } else {
      $return .= $emptyStar;
    }
  }

  return $return;
}



?>