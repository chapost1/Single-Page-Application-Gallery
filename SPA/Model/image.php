<?php

class image {

    public $id;
    public $category;
    public $name;
    public $location;

    function __construct($id, $category, $name, $location) {
        if(!($id === "")){
            $this->id = $id;
        }
        $this->category = $category;
        $this->name = $name;
        $this->location = $location;
    }

}
