<?php
class CategoryModel extends Model {
    public function getAllCategory(){
        $categories = [];

        $req = $this->getDb()->query('SELECT `cid`, `cname`, `cslug` FROM `category`');

        while($category = $req->fetch(PDO::FETCH_ASSOC)){
            $categories[] = new Category($category);
        }
        return $categories;
    }
}