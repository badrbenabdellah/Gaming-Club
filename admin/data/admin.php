<?php

function getAdminById($admin_id,$conn){
    $sql = "SELECT * FROM coachs WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$admin_id]);

    if ($stmt->rowCount() == 1) {
        $coach = $stmt->fetch();
        return $coach;
    }else {
        return 0;
    }
}



// fonction de tous les coachs
function getAllAdmins($conn){
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
function unameIsUnique($uname, $conn, $admin_id=0){
    $sql = "SELECT username, admin_id FROM coachs
            WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname]);
    
    if ($admin_id == 0) {
      if ($stmt->rowCount() >= 1) {
        return 0;
      }else {
       return 1;
      }
    }else {
     if ($stmt->rowCount() >= 1) {
        $coach = $stmt->fetch();
        if ($coach['admin_id'] == $admin_id) {
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
function removeAdmin($id, $conn){
    $sql = "DELETE FROM coachs WHERE admin_id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

function SearchAdmin($key,$conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM coachs 
            WHERE admin_id LIKE ? 
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