<?php

/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 19.06.17
 * Time: 16:41
 */
require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
class ConstantPost
{
    public $Id;
    public $Language;
    public $Type;
    public $Title;
    public $Content;
    public $ImageId;

    public function __construct($Id, $Language, $Type, $Title, $Content, $ImageId) {
        $this->Id = $Id;
        $this->Language = $Language;
        $this->Type = $Type;
        $this->Title = $Title;
        $this->Content = $Content;
        $this->ImageId = $ImageId;
    }

}
?>