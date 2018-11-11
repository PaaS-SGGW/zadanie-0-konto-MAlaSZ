<?php
    include_once __DIR__.'/en-US/ui.php';
    include_once __DIR__.'/pl-PL/ui.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    class Language {
        public static $LANG;
        public static $OPTIONS;
        public static function SetLang($lang)
        {
            global $TEXT;
            self::$LANG=$TEXT[$lang];
            self::$OPTIONS = $TEXT['Languages'];
        }
    }
    if(!isset($_SESSION['Lang']))
        $_SESSION['Lang'] = 'pl-PL';
    Language::SetLang($_SESSION['Lang']);




?>