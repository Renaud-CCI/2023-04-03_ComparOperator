<?php


//Fonction pour rajouter des étoiles en fonction de la note
function ranking($note){
  $fullStar = "<i class='fa-solid fa-star'></i>";
  $halfStar = "<i class='fa-regular fa-star-half-stroke'></i>";
  $emptyStar = "<i class='fa-regular fa-star'></i>";

  return ($note*10)%10;
}




?>