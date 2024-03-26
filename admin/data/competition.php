<?php 

function getAllCompetitions($conn){
    $sql = "SELECT * FROM competition";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $competitions = $stmt->fetchAll();
        return $competitions;
    }else {
        return 0;
    }
}

function removeCompetition($id, $conn){
    $sql = "DELETE FROM competition WHERE competition_id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

function getCompetitionById($id, $conn){
    $sql = "SELECT * FROM competition
            WHERE competition_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() == 1) {
      $competition = $stmt->fetch();
      return $competition;
    }else {
     return 0;
    }
 }
 function SearchCompetition($key,$conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM competition 
            WHERE competition_id LIKE ? 
            OR title Like ?
            OR prizes Like ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key]);
  
    if ($stmt->rowCount() == 1) {
        $competitions = $stmt->fetchAll();
        return $competitions;
    }else {
        return 0;
    }
  }


?>