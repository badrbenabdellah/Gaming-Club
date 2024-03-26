<?php 

function getAllUsers($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $students = $stmt->fetchAll();
     return $students;
   }else {
   	return 0;
   }
}

function removeUser($id, $conn){
   $sql  = "DELETE FROM students
           WHERE user_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
function getUserById($id, $conn){
   $sql = "SELECT * FROM students
           WHERE user_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     $student = $stmt->fetch();
     return $student;
   }else {
    return 0;
   }
}

function unameIsUnique($uname, $conn, $user_id=0){
   $sql = "SELECT username, user_id FROM students
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($user_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $student = $stmt->fetch();
       if ($student['user_id'] == $user_id) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

function SearchUser($key,$conn){
  $key = "%{$key}%";
  $sql = "SELECT * FROM students 
          WHERE user_id LIKE ? 
          OR fname Like ?
          OR lname Like ?
          OR username Like ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$key, $key, $key, $key]);

  if ($stmt->rowCount() == 1) {
      $students = $stmt->fetchAll();
      return $students;
  }else {
      return 0;
  }
}

 ?>