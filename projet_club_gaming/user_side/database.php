<!-- fichier database.php -->
<?php
require "db-config.php";
class Database
{
    public static function addUsers($username, $email,$fname, $lname, $password, $profile_photo)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $cle = rand(1000000, 9000000);
            if(empty($profile_photo)){
                $profile_photo = '../img/user_profile_image/author_3.png';
            }
            $stmt = $PDO->prepare("INSERT INTO users (email, password, profile_photo, username,fname,lname, cle) VALUES (:email, :password, :profile_photo, :username,:fname,:lname, :cle)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':profile_photo', $profile_photo);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':cle', $cle);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
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

    public static function getAllUsers()
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM users WHERE is_admin = FALSE';
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return 0;
            }
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
    public static function getAllNews()
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM news';
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            $stmt = $PDO->prepare("SELECT * FROM tournament ORDER BY start_date DESC LIMIT :limit OFFSET :offset");
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

    public static function AlreadyHaveParticipation($name, $id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM participation WHERE name =: name AND id:= id ");
            $stmt->bindParam(":name",$name);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getAllAdmins(){
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("SELECT * FROM users WHERE is_admin = true");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getAdminById($id){
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function removeAdmin($id){
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'DELETE FROM users WHERE id=?';
            //$stmt = $PDO->prepare($sql);
            $stmt = $PDO->prepare($sql);
            $stmt = $stmt->execute([$id]);
            //$stmt->bindParam(':id', $id);
            //$stmt->execute();
            if ($stmt) {
                return 1;
            }else {
                return 0;
            }
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function unameIsUnique($uname,$admin_id=0){
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = "SELECT username, id FROM users
            WHERE username := uname";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':uname', $uname);
            $stmt->execute();
            if ($admin_id == 0) {
                if ($stmt->rowCount() >= 1) {
                    return 0;
                }else {
                    return 1;
                }
            }else {
                if ($stmt->rowCount() >= 1) {
                    $admin = $stmt->fetch();
                    if ($admin['id'] == $admin_id) {
                        return 1;
                    }else {
                        return 0;
                    }
                }else {
                    return 1;
                }
            }

        }catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function SearchAdmin($key){
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $key = "%{$key}%";
            $sql = "SELECT * FROM users 
                WHERE fname LIKE :k
                OR lname LIKE :k
                OR username LIKE :k";
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':k', $key);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $admins = $stmt->fetchAll();
                return $admins;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function AddNews($title, $content, $date,$image_path)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("INSERT INTO news (title, content, date, image_path) VALUES (:title, :content, :date, :image_path)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->execute();
        }catch (PDOException $e){
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function updateNewsById($id,$title,$content)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'UPDATE news SET title = :title, content = :content WHERE nid = :id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function removeNewsbyId($id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'DELETE FROM news WHERE nid = :id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function getAllTournament()
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'SELECT * FROM tournament';
            $stmt = $PDO->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() >= 1) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else {
                return 0;
            }
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function addTournament($title, $description, $start_date, $end_date, $price, $conditions,$image_path)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $stmt = $PDO->prepare("INSERT INTO tournament (title, detail, start_date, end_date, price, conditions, image_path) VALUES (:title, :description, :start_date, :end_date, :price, :conditions, :image_path)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':conditions', $conditions);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function updateTournamentById($id,$title,$description,$start_date,$end_date,$price,$conditions)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'UPDATE tournament SET title = :title, detail = :detail,start_date = :start_date, end_date = :end_date,price = :price, conditions = :conditions  WHERE id = :id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':detail', $description);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':conditions', $conditions);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }

    public static function removeTournament($id)
    {
        try {
            global $DB_DSN, $DB_USER, $DB_PASS, $DB_OP;
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OP);
            $sql = 'DELETE FROM tournament WHERE id = :id';
            $stmt = $PDO->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERREUR: '.$e->getMessage();
        }
    }
}
?>
