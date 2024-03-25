<!-- fichier database.php -->
<?php
require "db-config.php";
class Database
{
    public static function addUsers($username, $email, $password, $profile_photo)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $cle = rand(1000000, 9000000);
            if($profile_photo == null){
                $profile_photo = '../img/user_profile_image/author_3.png';
            }
            $stmt = $PDO->prepare("INSERT INTO users (email, password, profile_photo, username, cle) VALUES (:email, :password, :profile_photo, :username, :cle)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':profile_photo', $profile_photo);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':cle', $cle);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getUsers($username)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM users WHERE username = :username';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getUserById($user_id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM users WHERE id = :user_id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getUserByIdKey($user_id, $key)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM users WHERE id = :user_id AND cle = :key';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':key', $key);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function updateUserIsComfirm($is_conf, $user_id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'UPDATE users SET is_confirm = :confirm WHERE id = :user_id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':confirm', $is_conf);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getNews()
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM news';
            return $PDO->query($sql);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    // Méthode pour récupérer les actualités pour une page donnée avec une limite et un décalage
    public static function getNewsPerPage($limit, $offset) {

        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM news ORDER BY date DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    // Méthode pour compter le nombre total d'actualités
    public static function countNews() {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT COUNT(*) FROM news");
            $stmt->execute();
            // Retourne le nombre total d'actualités
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getNewsById($news_id) {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM news WHERE nid = :id");
            $stmt->bindParam(':id', $news_id, PDO::PARAM_INT);
            $stmt->execute();
            // Retourne les détails de l'actualité
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getPreviousNewsId($current_news_id) {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT nid FROM news WHERE nid < :current_news_id ORDER BY nid DESC LIMIT 1");
            $stmt->bindParam(':current_news_id', $current_news_id, PDO::PARAM_INT);
            $stmt->execute();

            // Récupération de l'identifiant de l'actualité précédente
            // Retourne l'identifiant de l'actualité précédente
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function getNextNewsId($current_news_id) {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT nid FROM news WHERE nid > :current_news_id ORDER BY nid ASC LIMIT 1");
            $stmt->bindParam(':current_news_id', $current_news_id, PDO::PARAM_INT);
            $stmt->execute();

            // Récupération de l'identifiant de l'actualité suivante
            // Retourne l'identifiant de l'actualité suivante
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    // Méthode pour ajouter un commentaire
    public static function addComment($news_id, $user_id, $content) {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("INSERT INTO comments (news_id, user_id, comment_text) VALUES (:news_id, :user_id, :content)");
            $stmt->bindParam(':news_id', $news_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    // Méthode pour récupérer les commentaires associés à une actualité
    public static function getCommentsByNewsId($news_id) {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM comments WHERE news_id = :news_id");
            $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getTournamentPerPage($limit, $offset)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM tournament ORDER BY date DESC LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function countTournament()
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT COUNT(*) FROM tournament");
            $stmt->execute();
            // Retourne le nombre total d'actualités
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getTournamentById($tounament_id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM tournament WHERE id = :id");
            $stmt->bindParam(':id', $tounament_id, PDO::PARAM_INT);
            $stmt->execute();
            // Retourne les détails du tournoi
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
    public static function addParticipations($tournament_id, $name, $email)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("INSERT INTO participation (tournament_id, name, email) VALUES (:tournament_id, :name, :email)");
            $stmt->bindParam(':tournament_id', $tournament_id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
}
?>
