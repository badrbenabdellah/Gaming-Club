<?php

function getCoachById($coach_id,$conn){
    $sql = "SELECT * FROM coachs WHERE coach_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$coach_id]);

    if ($stmt->rowCount() == 1) {
        $coach = $stmt->fetch();
        return $coach;
    }else {
        return 0;
    }
}



// fonction de tous les coachs
function getAllCoachs($conn){
    $sql = "SELECT * FROM coachs";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        $coachs = $stmt->fetchAll();
        return $coachs;
    }else {
        return 0;
    }
}

//check if the Username Unique
function unameIsUnique($uname, $conn, $coach_id=0){
    $sql = "SELECT username, coach_id FROM coachs
            WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);
    
    if ($coach_id == 0) {
      if ($stmt->rowCount() >= 1) {
        return 0;
      }else {
       return 1;
      }
    }else {
     if ($stmt->rowCount() >= 1) {
        $coach = $stmt->fetch();
        if ($coach['coach_id'] == $coach_id) {
          return 1;
        }else {
         return 0;
       }
      }else {
       return 1;
      }
    }
    
 }

//DELETE
function removeCoach($id, $conn){
    $sql = "DELETE FROM coachs WHERE coach_id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

function SearchCoach($key,$conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM coachs 
            WHERE coach_id LIKE ? 
            OR fname Like ?
            OR lname Like ?
            OR username Like ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key, $key]);

    if ($stmt->rowCount() == 1) {
        $coachs = $stmt->fetchAll();
        return $coachs;
    }else {
        return 0;
    }
}
?>