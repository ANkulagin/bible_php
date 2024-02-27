<?php

namespace trait;

trait Image
{
    private string $path;

    public function getImage():string
    {
        echo "image <br> ";
        return $this->path;
    }
    public function setImage(string $path):void
    {
        $this->path =$path;
    }
}