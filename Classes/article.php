<?php 
class Article{
    private $db;
    public function __construct($db){
        $this->db=$db;
    }

    public function addArticle($title, $description, $image, $currentDateTime, $userId, $theme_id, $json){
        $sql ="INSERT INTO article (article_title, content, article_image, created_at, author_id, theme_id, article_tags)
        VALUES ('$title', '$description', '$image', '$currentDateTime', '$userId', '$theme_id', '$json')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();        
      return $stmt;         
    }
    
   
    public function selecyArticle($theme_id){
        $sql = "SELECT a.article_id, a.article_title, a.content, a.article_image, DATE_FORMAT(a.created_at, '%Y-%m-%d') as created_at, u.nom
        FROM article a
        JOIN users u ON a.author_id = u.user_id
        WHERE theme_id = :theme_id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function selectArticle_info($article){
        $sql = "SELECT a.article_id, a.article_title, a.content, a.article_image, DATE_FORMAT(a.created_at, '%Y-%m-%d') as created_at, u.nom
        FROM article a
        JOIN users u ON a.author_id = u.user_id
        WHERE a.article_id = :article"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':article', $article, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt;
    }
    
    

    public function selectTags($theme_id){
        $sql ="SELECT * FROM tags WHERE theme_id ='$theme_id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }











}









?>