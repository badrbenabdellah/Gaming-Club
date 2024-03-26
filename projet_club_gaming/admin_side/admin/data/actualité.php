<?php
// Cette fonction récupère toutes les actualités depuis la base de données
function getAllActualites($conn) {
    try {
        $sql = "SELECT * FROM actualités";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Vérifie s'il y a des actualités récupérées
        if ($stmt->rowCount() > 0) {
            // Récupère toutes les actualités sous forme de tableau associatif
            $actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $actualites;
        } else {
            // Aucune actualité trouvée
            return [];
        }
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function removeActualite($id, $conn){
    $sql = "DELETE FROM actualités WHERE id=?";
    $stmt = $conn->prepare($sql);
    $re = $stmt->execute([$id]);

    if ($re) {
        return 1;
    }else {
        return 0;
    }
}

function getActualitéById($id,$conn){
    $sql = "SELECT * FROM actualités WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 1) {
        $actualité = $stmt->fetch();
        return $actualité;
    }else {
        return 0;
    }
}
function SearchActualité($key,$conn){
    $key = "%{$key}%";
    $sql = "SELECT * FROM actualités 
            WHERE id LIKE ? 
            OR title Like ?
            OR content Like ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key, $key]);

    if ($stmt->rowCount() == 1) {
        $actualités = $stmt->fetchAll();
        return $actualités;
    }else {
        return 0;
    }
}
?>