<?php

/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 18.06.17
 * Time: 11:13
 */
class Image
{
    public $Id;
    public $Name;
    public $Path;

    public function __construct($Id, $Name, $Path)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Path = $Path;
    }
}