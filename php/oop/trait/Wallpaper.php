<?php

namespace trait;

trait Wallpaper
{
    private string $path;

    public function getImage():string
    {
        echo "Wallpaper <br>" ;
        return $this->path;
    }
    public function setImage(string $path):void
    {
        $this->path =$path;
    }
}