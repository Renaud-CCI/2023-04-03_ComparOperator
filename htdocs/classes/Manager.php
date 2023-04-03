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

  public function getTourOperatorGrade (int $tour_operator_id){
    $query = $this->db->prepare(' SELECT AVG(value)
                                  FROM score
                                  WHERE tour_operator_id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);
        
    $tourOperatorGrade = $query->fetch(PDO::FETCH_ASSOC); 

    return $tourOperatorGrade; 
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