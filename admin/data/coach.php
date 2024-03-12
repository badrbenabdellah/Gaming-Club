<?php

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
function unameIsUnique($uname, $conn){
    $sql = "SELECT username FROM coachs WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);

    if ($stmt->rowCount() >= 1) {
        return 0;
    }else {
        return 1;
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

?>