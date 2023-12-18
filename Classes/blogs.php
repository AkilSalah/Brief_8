<?php 
class Blogs {
    private $db ; 
    public function __construct($db){
        $this->db=$db;
    }
    public function selectTheme(){
        $sql="SELECT * FROM theme ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function NbArticle($theme_id){
      $sql = "SELECT COUNT(article.article_id) AS nb_article FROM article JOIN theme ON theme.theme_id = article.theme_id WHERE theme.theme_id = $theme_id";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }





}
































?>