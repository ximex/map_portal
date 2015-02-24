<?php

class Map {
    public $id;
    public $name;
    public $description;
    public $author;
    public $build;
    public $request;
    public $active;
    public $bounds;
    public $startpoint;
    public $layers;

    function __construct($id, $name, $description, $author, $build, $request, $active, $bounds, $startpoint, $layers) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->author = $author;
        $this->build = $build;
        $this->request = $request;
        $this->active = $active;
        $this->layers = $layers;
    }
}