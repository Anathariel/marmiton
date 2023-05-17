<?php

class Category
{
    private $cid;
    private $cname;
    private $cslug;

    public function __construct(array $post)
    {
        $this->hydrate($post);
    }

    private function hydrate(array $post)
    {
        foreach ($post as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    //GETTERS
    public function getCid()
    {
        return $this->cid;
    }

    public function getCname()
    {
        return $this->cname;
    }

    public function getCslug()
    {
        return $this->cslug;
    }

    //SETTERS
    public function setCid(int $cid){
        $this->cid=$cid;
    }
    public function setCname(string $cname){
        $this->cname=$cname;
    }
    public function setCslug(string $cslug){
        $this->cslug=$cslug;
    }
}
