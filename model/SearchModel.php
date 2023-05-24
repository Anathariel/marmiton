<?php

class SearchModel extends Model{
    public function getSearchResult($search){
        $research = strtolower($search);
        $search = '%' . $research . '%';
        
        $req = $this->getDb()->prepare("SELECT `id`, `author`, `title`, `thumbnail`, `content`, `created_at` 
        FROM `recipe`  
        WHERE `title` LIKE :search 
        OR `duration` LIKE :search 
        OR `content` LIKE :search 
        ORDER BY id");
        $req->bindParam(':search', $search, PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}