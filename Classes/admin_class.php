<?php
class  Admin {
    private $db;

    public function __construct($con){
        $this->db=$con;
    }

    public function addCategory($nom){
        $sql = "INSERT INTO categories (name_cat) values ('$nom')";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function updateCategory ($nom,$id){
        $sql = "UPDATE categories SET name_cat = '$nom' WHERE id_cat = '$id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function deleteCategory ($id){
        $sql = "DELETE FROM categories WHERE id_cat = '$id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function afficherCategory_u($id_u) {
        $sql = "SELECT id_cat, name_cat FROM categories WHERE id_cat = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $id_u);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function afficherCategory (){
        $sql = "SELECT * FROM categories";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function addProduct ($img_pro,$nom_pro,$prix_pro,$id_cat){
        $sql = "INSERT INTO  `plants`( `image_url`, `name_plant`, `price`,`category_id` ) VALUES  ('$img_pro','$nom_pro','$prix_pro','$id_cat')";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function updateProduct ($nom_p,$id_p,$img,$prix,$nom_c){
        $sql =  "UPDATE plants
        JOIN categories ON plants.category_id = categories.id_cat
        SET plants.image_url = '$img', plants.name_plant = '$nom_p', plants.price = '$prix', categories.name_cat = '$nom_c'
        WHERE plants.id_plant = $id_p";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function afficherProduct (){
        $sql = "SELECT * FROM plants join categories on plants.category_id = categories.id_cat";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function deleteProduct ($id){
        $sql = "DELETE FROM plants WHERE id_plant = '$id'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function afficherProduit_u($id_u) {
        $sql = "SELECT * FROM plants WHERE id_plant = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $id_u);
        $stmt->execute();

        return $stmt;
    }
    public function afficherTheme_u($id_u) {
        $sql = "SELECT * FROM theme 
                JOIN tags ON theme.theme_id = tags.theme_id 
                WHERE theme.theme_id = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u', $id_u);
        $stmt->execute();
        return $stmt;
    }
    public function addTheme($t_image, $t_name, $t_desc) {
        $sql = "INSERT INTO theme (theme_name, theme_image, theme_desc) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $t_name);
        $stmt->bindParam(2, $t_image);
        $stmt->bindParam(3, $t_desc);
        $stmt->execute();
        return $stmt;
    }
    public function insertTags($theme_id, $tags) {
        $array = explode(",", $tags);
    
        $query = "INSERT INTO tags (tag_name, theme_id) VALUES (:tag_name, :theme_id)";
        $stmt = $this->db->prepare($query);
    
        foreach ($array as $e) {
            $stmt->bindParam(':tag_name', $e);
            $stmt->bindParam(':theme_id', $theme_id);
    
            $result = $stmt->execute();
    
            if (!$result) {
                return false;
            }
        }
        return true;
    }
    public function selectThemeId($name_t){
        $sql = "SELECT theme_id FROM theme WHERE theme_name = :name_t";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name_t', $name_t);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            return $result['theme_id'];
        } else {
            return false;
        }
     }
     public function afficherTheme (){
        $sql = "SELECT * FROM theme ";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function afficherTags ($theme_id){
        $sql = "SELECT * FROM tags where theme_id=$theme_id ";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteTheme($id_theme){
        $sql = "DELETE FROM theme WHERE theme_id = '$id_theme'";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt; 
    }

    public function updateTheme($new_name, $new_image, $new_desc, $theme_id) {
        $sql = "UPDATE theme SET theme_name = :new_name, theme_image = :new_image, theme_desc = :new_desc WHERE theme_id = :theme_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':new_name', $new_name);
        $stmt->bindParam(':new_image', $new_image);
        $stmt->bindParam(':new_desc', $new_desc);
        $stmt->bindParam(':theme_id', $theme_id);
        $result = $stmt->execute();
        return $result;
    }

    public function nbAdmin(){
        $sql = "SELECT COUNT(*) as nbAdmin FROM users WHERE user_type = 2";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['nbAdmin'];
    }
    public function nbClient(){
        $sql = "SELECT COUNT(*) as nbClient FROM users WHERE user_type = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['nbClient'];
    }
    
    public function nbCommande(){
        $sql = "SELECT COUNT(*) as nbCommande FROM commands";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['nbCommande'];
    }
    
    public function nbCategories(){
        $sql = "SELECT COUNT(*) as nbCat FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['nbCat'];
    }
    
    public function nbProducts(){
        $sql = "SELECT COUNT(*) as nbProduct FROM plants";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['nbProduct'];
    }
    
    


    



    
    
    










}

?>