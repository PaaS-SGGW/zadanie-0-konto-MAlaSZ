<?php

/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 5/25/17
 * Time: 2:31 PM
 */
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');

class Post
{
    public $Id;
    public $Title;
    public $ImageId;
    public $Date;
    public $UserID;
    public $Content;
    public $Summary;
    public $Language;

    public function __construct($Id, $Title,$ImageId, $Date, $UserId, $Content, $Summary, $Language)
    {
        $this->Id = $Id;
        $this->Title = $Title;
        $this->ImageId = $ImageId;
        $this->Date = $Date;
        $this->UserID = $UserId;
        $this->Content = $Content;
        $this->Summary = $Summary;
        $this->Language = $Language;
    }
}

?>