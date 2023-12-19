<?php
class  Admin {
    private $db;
    private $categorieNom;
    private $categorieId;
    private $productName;
    private $productId;
    private $productPrice;
    private $productImage;
    private $themeId;
    private $themeName;
    private $themeImage;
    private $themeDesc;
    private $tagName;


    public function __construct($con){
        $this->db=$con;
    }
    public function get_categorieNom(){
        return $this->categorieNom;
    }
    public function set_categorieNom($categorieNom){
        $this->categorieNom=$categorieNom;
    }
    public function get_categorieId(){
        return $this->categorieId;
    }
    public function set_categorieId($categorieId){
        $this->categorieId=$categorieId;
    }
    public function get_productName(){
        return $this->productName;
    }
    public function set_productName($productName){
        $this->productName=$productName;
    }
    public function get_productId(){
        return $this->productId;
    }
    public function set_productId($productId){
        $this->productId=$productId;
    }
    public function get_productPrice(){
        return $this->productPrice;
    }
    public function set_productPrice($productPrice){
        $this->productPrice=$productPrice;
    }
    public function get_productImage(){
        return $this->productImage;
    }
    public function set_productImage($productImage){
        $this->productImage=$productImage;
    }
    public function get_themeId(){
        return $this->themeId;
    }
    public function set_themeId($themeId){
        $this->themeId=$themeId;
    }
    public function get_themeName(){
        return $this->themeName;
    }
    public function set_themeName($themeName){
        $this->themeName=$themeName;
    }
    public function get_themeImage(){
        return $this->themeImage;
    }
    public function set_themeImage($themeImage){
        $this->themeImage=$themeImage;
    }
    public function get_themeDesc(){
        return $this->themeDesc;
    }
    public function set_themeDesc($themeDesc){
        $this->themeDesc=$themeDesc;
    }
    public function get_tagName(){
        return $this->tagName;
    }
    public function set_tagName($tagName){
        $this->tagName=$tagName;
    }

    public function addCategory(){
        $cat_name=$this->get_categorieNom();
        $sql = "INSERT INTO categories (name_cat) values (:name_cat)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name_cat',$cat_name);
        $stmt->execute();
        return $stmt;
    }
    public function updateCategory (){
        $sql = "UPDATE categories SET name_cat = :name_cat WHERE id_cat = :id_cat";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name_cat',$this->get_categorieNom());
        $stmt->bindParam(':id_cat',$this->get_categorieId());
        $stmt->execute();
        return $stmt;
    }
    public function deleteCategory (){
        $id_cat =$this->get_categorieId();
        $sql = "DELETE FROM categories WHERE id_cat =:id_cat";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id_cat', $id_cat);
        $stmt->execute();
        return $stmt;
    }

    public function afficherCategory_u() {
        $cat_id=$this->get_categorieId();
        $sql = "SELECT id_cat, name_cat FROM categories WHERE id_cat = :id_cat";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cat',$cat_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function afficherCategory (){
        $sql = "SELECT * FROM categories";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function addProduct (){
        $sql = "INSERT INTO  `plants`( `image_url`, `name_plant`, `price`,`category_id` ) VALUES  (:img_pro,:nom_pro,:prix_pro,:id_cat)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':img_pro',$this->get_productImage());
        $stmt->bindParam(':nom_pro',$this->get_productName());
        $stmt->bindParam(':prix_pro',$this->get_productPrice());
        $stmt->bindParam(':id_cat',$this->get_categorieId());
        $stmt->execute();
        return $stmt;
    }
    public function updateProduct (){

        // $sql =  "UPDATE plants
        // JOIN categories ON plants.category_id = categories.id_cat
        // SET plants.image_url = :img, plants.name_plant = :nom_p, plants.price = :prix
        // WHERE plants.id_plant = :id_p";
        $sql =  "UPDATE plants
        SET plants.category_id = :id_cat, plants.image_url = :img, plants.name_plant = :nom_p, plants.price = :prix
        WHERE plants.id_plant = :id_p";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam('img',$this->get_productImage());
        $stmt->bindParam('nom_p',$this->get_productName());
        $stmt->bindParam('prix',$this->get_productPrice());
        $stmt->bindParam(':id_cat',$this->get_categorieId());
        $stmt->bindParam('id_p',$this->get_productId());
        $stmt->execute();
        return $stmt;
    }

    public function afficherProduct (){
        $sql = "SELECT * FROM plants join categories on plants.category_id = categories.id_cat";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function deleteProduct (){
        $id_product = $this->get_productId();
        $sql = "DELETE FROM plants WHERE id_plant = :id ";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id',$id_product);
        $stmt->execute();
        return $stmt;
    }
    public function afficherProduit_u() {
        $id_product = $this->get_productId();
        $sql = "SELECT * FROM plants WHERE id_plant = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u',$id_product);
        $stmt->execute();
        return $stmt;
    }
    public function afficherTheme_u() {
        $theme_id=$this->get_themeId();
        $sql = "SELECT * FROM theme 
                JOIN tags ON theme.theme_id = tags.theme_id 
                WHERE theme.theme_id = :id_u";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_u',$theme_id);
        $stmt->execute();
        return $stmt;
    }
    public function addTheme() {
        $sql = "INSERT INTO theme (theme_name, theme_image, theme_desc) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $this->get_themeName());
        $stmt->bindParam(2, $this->get_themeImage());
        $stmt->bindParam(3, $this->get_themeDesc());
        $stmt->execute();
        return $stmt;
    }
    public function insertTags( $tags) {
        $array = explode(",", $tags);
    
        $query = "INSERT INTO tags (tag_name, theme_id) VALUES (:tag_name, :theme_id)";
        $stmt = $this->db->prepare($query);
    
        foreach ($array as $e) {
            $stmt->bindParam(':tag_name', $e);
            $stmt->bindParam(':theme_id', $this->get_themeId());
            $result = $stmt->execute();
    
            if (!$result) {
                return false;
            }
        }
        return true;
    }
    public function selectThemeId(){
        $sql = "SELECT theme_id FROM theme WHERE theme_name = :name_t";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name_t',$this->get_themeName());
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
   
    public function afficherTags (){
        $themeId = $this->get_themeId();
        $sql = "SELECT * FROM tags where theme_id= :theme_id ";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':theme_id',$themeId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function deleteTheme(){
        $sql = "DELETE FROM theme WHERE theme_id = :id_theme";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id_theme',$this->get_themeId());
        $stmt->execute();
        return $stmt;
    }

    public function updateTheme() {
        $themeDec =$this->get_themeDesc();
        $sql = "UPDATE theme SET theme_name = :new_name, theme_image = :new_image, theme_desc = :new_desc WHERE theme_id = :theme_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':new_name', $this->get_themeName());
        $stmt->bindParam(':new_image', $this->get_themeImage());
        $stmt->bindParam(':new_desc', $themeDec);
        $stmt->bindParam(':theme_id', $this->get_themeId());
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