<?php

class Manager {
  private $db; 

  public function __construct(PDO $db){
      $this->setDb($db);
  }


  public function createTourOperator(TourOperator $tourOperator){
    $query = $this->db->prepare(' INSERT INTO tour_operator (name, link)
                                  VALUES (:name, :link)');
    $query->execute([ 'name' => $tourOperator->getName(),
                      'link' => $tourOperator->getLink()]);
  }

  public function createDestination(Destination $destination){
    $query = $this->db->prepare(' INSERT INTO tour_operator (location, price, tour_operator_id)
                                  VALUES (:location, :price, :tour_operator_id)');
    $query->execute([ 'location' => $destination->getLocation(),
                      'price' => $destination->getPrice(),
                      'tour_operator_id' => $destination->getTour_operator_id()]);
  }

  public function getTour_operator(int $tour_operator_id){
    $query = $this->db->prepare(' SELECT *
                                  FROM tour_operator
                                  WHERE id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);

    $tourOperatorData = $query->fetch(PDO::FETCH_ASSOC);

    return new TourOperator($tourOperatorData);
  }

  public function getAllOperator(){
    $query = $this->db->query(' SELECT * FROM tour_operator
                                ORDER BY name');

    $allOperatorsData = $query->fetchAll(PDO::FETCH_ASSOC); 

        $allOperatorsAsObjects = [];        
        
        foreach ($allOperatorsData as $operatorData) {
            $opratorAsObject = new TourOperator($operatorData);
            array_push($allOperatorsAsObjects, $opratorAsObject);
        }
        
        return $allOperatorsAsObjects; 
  }

  public function getTourOperatorScore (int $tour_operator_id){
    $query = $this->db->prepare(' SELECT AVG(value)
                                  FROM score
                                  WHERE tour_operator_id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);
        
    $tourOperatorScore = $query->fetch(PDO::FETCH_ASSOC); 

    return intval($tourOperatorScore['AVG(value)']*10)/10; 
  }

  public function getAllLocations(){
    $query = $this->db->query(' SELECT DISTINCT location
                                FROM destination
                                ORDER BY location');
    $allLocations = $query->fetchAll(PDO::FETCH_ASSOC); 
    
    $locationNames = array_column($allLocations, 'location');

    return $locationNames;
  }

  public function getDestinationsForLocation(string $location){
    $query = $this->db->prepare(' SELECT *
                                FROM destination
                                WHERE location = :location
                                ORDER BY id');
    $query->execute(['location' => $location,]);                            
    $allDestinationsDatas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allDestinationsAsObjects = [];        
    
    foreach ($allDestinationsDatas as $destinationDatas) {
        $destinationAsObject = new Destination($destinationDatas);
        array_push($allDestinationsAsObjects, $destinationAsObject);
    }
    
    return $allDestinationsAsObjects; 
  }

  public function getReviewsForTourOperator(int $tour_operator_id){
    $query = $this->db->prepare(' SELECT review.message, author.name
                                  FROM review
                                  INNER JOIN author
                                  ON review.author_id = author.id
                                  WHERE review.tour_operator_id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);
        
    $allReviewsDatas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allReviewsAsObjects = [];        
        
    foreach ($allReviewsDatas as $reviewData) {
      $reviewAsObject = new Review($reviewData);
      array_push($allReviewsAsObjects, $reviewAsObject);
    }

    return $allReviewsAsObjects;
  }

  public function updateOperatorToPremium(int $tour_operator_id){
    $query = $this->db->prepare('   UPDATE tour_operator 
                                    SET premium_status = 1 
                                    WHERE id = :tour_operator_id');

    $query->execute(['tour_operator_id' => $tour_operator_id]);
  }


  // SETTERS & GETTERS
  public function getDb(){
    return $this->db;
  }

  public function setDb($db){
    $this->db = $db;

    return $this;
  }
}