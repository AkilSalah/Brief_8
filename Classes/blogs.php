<?php 
class Blogs {
    private $db; 
    private $id_theme;
    public function __construct($db){
        $this->db=$db;
    }

    public function get_theme(){
        return $this->id_theme;
    }
    public function set_theme($id_theme){
        $this->id_theme = $id_theme;
    }
    public function selectTheme(){
        $sql="SELECT * FROM theme ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function NbArticle(){
        $id_theme= $this->get_theme();
      $sql = "SELECT COUNT(article.article_id) AS nb_article FROM article JOIN theme ON theme.theme_id = article.theme_id WHERE theme.theme_id = :theme_id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':theme_id',$id_theme);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }





}
































?>