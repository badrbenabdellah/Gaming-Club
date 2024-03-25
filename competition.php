<?php
include "Connexion_BDD.php";

// Sélectionnez toutes les compétitions de la base de données
$sql = "SELECT * FROM competition";
$stmt = $conn->prepare($sql);
$stmt->execute();
$competitions = $stmt->fetchAll();
?>
