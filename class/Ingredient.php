<?php

class Ingredient {

    private $id;
    private $name;
    private $slug;

    public function __construct(array $post){
        $this->hydrate($post);
    }

    private function hydrate(array $post){
        foreach ($post as $key => $value){
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

// GETTERS

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getSlug(){
        return $this->slug;
    }

// SETTERS
    public function setId(int $id){
        $this->id=$id;
    }

    public function setName(string $name){
        $this->name=$name;
    }
    public function setSlug(string $slug){
        $this->slug=$slug;
    }
}