<?php

class Layer {
    public $id;
    public $mapid;
    public $name;
    public $url;
    public $layers;
    public $format;

    function __construct($id, $mapid, $name, $url, $layers, $format) {
        $this->id = $id;
        $this->mapid = $mapid;
        $this->name = $name;
        $this->url = $url;
        $this->layers = $layers;
        $this->format = $format;
    }
}