<?php

class Recipe {
    private $id;
    private $author;
    private $title;
    private $thumbnail;
    private $content;
    private $created_at;


    public function __construct(array $post){
        $this->hydrate($post);
    }

    private function hydrate(array $post){
        foreach($post as $key => $value){
            $method = 'set' . ucfirst($key);

            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getThumbnail(){
        return $this->thumbnail;
    }
    public function getContent(){
        return $this->content;
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public function getAuthor(){
        return $this->author;
    }

    //SETTERS
    public function setId(int $id){
        $this->id=$id;
    }
    public function setTitle(String $title){
        $this->title=$title;
    }
    public function setThumbnail(String $thumbnail){
        $this->thumbnail = $thumbnail;
    }
    public function setContent(String $content){
        $this->content= $content;
    }
    public function setCreated_at(String $created_at){
        $this->created_at= $created_at;
    }
    public function setAuthor(String $author){
        $this->author= $author;
    }
}