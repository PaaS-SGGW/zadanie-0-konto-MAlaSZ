<?php
    //require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
/**
 * Created by PhpStorm.
 * User: malasz
 * Date: 5/25/17
 * Time: 2:09 PM
 */
class User
{
    public $Id;
    public $Name;
    public $Password;
    public $Login;
    public $Salt;
    public $Language;


    public static function GenerateSalt($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function __construct($Id,$Name, $Login, $Password, $Salt, $Language = "pl-PL")
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Login = $Login;
        $this->Password = $Password;
        $this->Salt = $Salt;
        $this->Language = $Language;
    }

    public function VerifyPassword($Password)
    {
        if(hash('sha512', $Password.$this->Salt) == $this->Password) {
            return true;
        }
        return false;
    }
}

?>
