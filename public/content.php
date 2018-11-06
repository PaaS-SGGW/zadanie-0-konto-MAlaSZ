<?php

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if(is_ajax())
{
    require_once (substr(__DIR__,0,strrpos(__DIR__,'public')).'router.php');


    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $type = $_GET['type'];


            switch ($type)
            {
                case 'article':
                    session_start();
                    $_SESSION['entryid'] = $_GET['id'];
                    if(file_exists(Router::$Views['Content']['Front']['Article']))
                        require_once (Router::$Views['Content']['Front']['Article']);
                    else require_once ('404.html');
                    break;
                case 'url':
                    $url = $_GET['url'];
                    if(file_exists(Router::$Views['Content']['Front'][$url]))
                        require_once (Router::$Views['Content']['Front'][$url]);
                    else require_once ('404.html');
                    break;
                case 'calendar':
                    require_once Router::$Scripts['Calendar'];
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                    $return->MonthYear = Calendar::GetMonth($month).' '.$year;
                    $return->Days = Calendar::GenerateCalendar($month, $year);
                    echo json_encode($return);
                    break;
                case 'controller':
                    session_start();
                    break;
                default:
                    include_once('404.html');

            }
            break;
        case 'POST':
            $type = $_POST['type'];
            $url = $_POST['url'];
            switch ($type){
                case 'Lang':
                    switch ($url) {
                        case 'Set':
                            session_start();
                            require_once Router::$Config['Language'];
                            if (strlen($_POST['Language']) != 5)
                                return;

                            $_SESSION['Lang'] = $_POST['Language'];
                            Language::SetLang($_POST['Language']);
                            return "OK";
                    }
                    break;

            }
            break;
    }


}


?>