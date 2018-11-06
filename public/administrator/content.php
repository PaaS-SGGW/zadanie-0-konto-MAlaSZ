<?php
//    if(file_exists('../../application/views/content/admin/'.$url.'.php'))
//        include_once('../../application/views/content/admin/'.$url.'.php');
//    else include_once('../404.html');


function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

if(is_ajax())
{
    session_start();
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true)
    {
        require_once (substr(__DIR__,0,strrpos(__DIR__,'public')).'router.php');
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $type = $_GET['type'];
                $url = $_GET['url'];

                switch ($type)
                {
                    case 'Images':
                        switch ($url)
                        {
                            case 'List':
                                file_exists(Router::$Controllers['Image']['List']);
                                if(file_exists(Router::$Controllers['Image']['List'])){
                                    require_once Router::$Controllers['Image']['List'];
                                    echo json_encode(GetPictures());
                                }
                                break;
                            case 'Upload':
                                break;
                        }
                        break;
                    case 'Page':

                        if(file_exists(Router::$Views['Content']['Admin'][$url]))
                            require_once (Router::$Views['Content']['Admin'][$url]);
                        else require_once ('404.html');
                        break;
                    case 'Post':
                        switch ($url)
                        {
                            case 'Edit':

                                $_SESSION['entryid'] = $_GET['Id'];
                                if(file_exists(Router::$Views['Content']['Admin']['EditEntry']))
                                    require_once (Router::$Views['Content']['Admin']['EditEntry']);
                                else require_once ('404.html');
                                break;
                        }
                        break;
                    case 'ConstantPost':
                        switch ($url)
                        {
                            case 'Edit':

                                $_SESSION['entryid'] = $_GET['Id'];
                                if(file_exists(Router::$Views['Content']['Admin']['EditBlogEntry']))
                                    require_once (Router::$Views['Content']['Admin']['EditBlogEntry']);
                                else require_once ('404.html');
                                break;
                        }
                        break;
                }

                break;
            case 'POST':
                $type = $_POST['type'];
                $url = $_POST['url'];

                switch ($type)
                {
                    case 'Post':
                        switch ($url)
                        {
                            case 'Create':
                                if(file_exists(Router::$Controllers['Post']['Create'])) {
                                    require_once(Router::$Controllers['Post']['Create']);
                                    require_once(Router::$Models['User']);
                                    $User =  $_SESSION['User'];
                                    echo Create(
                                        $_POST['Title'],
                                        $_POST['ImageId'],
                                        (get_object_vars($User)[Id]),
                                        $_POST['Content'],
                                        $_POST['Summary'],
                                        $_POST['Language']
                                    );

                            }
                                break;
                            case 'Edit':
                                if(file_exists(Router::$Controllers['Post']['Update'])) {
                                    require_once(Router::$Controllers['Post']['Update']);
                                    require_once(Router::$Models['User']);
                                    $User =  $_SESSION['User'];
                                    echo Update(
                                        $_POST['Id'],
                                        $_POST['Title'],
                                        $_POST['ImageId'],
                                        (get_object_vars($User)[Id]),
                                        $_POST['Content'],
                                        $_POST['Summary'],
                                        $_POST['Language']
                                    );

                                }
                                break;
                            case 'Delete':
                                if(file_exists(Router::$Controllers['Post']['Delete'])){
                                    require_once(Router::$Controllers['Post']['Delete']);
                                    echo Delete($_POST['Id']);
                                }
                                break;
                        }
                        break;
                    case 'ConstantPost':
                        switch ($url)
                        {
                            case 'Create':
                                if(file_exists(Router::$Controllers['ConstantPost']['Create'])) {
                                    require_once(Router::$Controllers['ConstantPost']['Create']);
                                    echo Create(
                                        $_POST['PostType'],
                                        $_POST['Language'],
                                        $_POST['Title'],
                                        $_POST['Content'],
                                        $_POST['ImageId']
                                    );

                                }
                                break;
                            case 'Edit':
                                if(file_exists(Router::$Controllers['ConstantPost']['Update'])) {
                                    require_once(Router::$Controllers['ConstantPost']['Update']);
                                    echo Update(
                                        $_POST['Id'],
                                        $_POST['PostType'],
                                        $_POST['Language'],
                                        $_POST['Title'],
                                        $_POST['Content'],
                                        $_POST['ImageId']
                                    );

                                }
                                break;
                            case 'Delete':
                                if(file_exists(Router::$Controllers['ConstantPost']['Delete'])){
                                    require_once(Router::$Controllers['ConstantPost']['Delete']);
                                    echo Delete($_POST['Id']);
                                }
                                break;
                        }
                        break;
                    case 'User':
                        switch($url)
                        {
                            case 'Update':
                                if(strlen($_POST['Name']) == 0)
                                    return Language::$LANG['UI']['Error']['EmptyName'];
                                if(strlen($_POST['Login']) < 5)
                                    return Language::$LANG['UI']['Error']['LoginTooShort'];
                                if(strlen($_POST['Password']) < 8)
                                    return Language::$LANG['UI']['Error']['PasswordTooShort'];
                                if($_POST['ConfirmPassword'] != $_POST['Password'])
                                    return Language::$LANG['UI']['Error']['PasswordsDontMatch'];
                                if(strlen($_POST['Language']) != 5)
                                    return Language::$LANG['UI']['Error']['IncorrectLang'];
                                if(file_exists(Router::$Controllers['User']['Update'])) {
                                    require_once (Router::$Controllers['User']['Update']);
                                    $Salt = User::GenerateSalt(255);
                                    $User = new User((get_object_vars($_SESSION['User'])[Id]),$_POST['Name'],$_POST['Login'], hash('sha512', $Password+$Salt),$Salt, $_POST['Language']);
                                    echo Update($User);
                                }
                            break;
                        }

                        break;
                    case 'Settings':
                        switch ($url)
                        {
                            case 'AboutPage':
                                require_once Router::$Config['Settings']['Update'];
                                if(ReadSettings()['AboutPage']=='Enabled')
                                    UpdateSettings('AboutPage','Disabled');
                                else
                                    UpdateSettings('AboutPage','Enabled');
                                break;
                            case 'ContactPage':
                                require_once Router::$Config['Settings']['Update'];

                                if(ReadSettings()['ContactPage']=='Enabled')
                                    UpdateSettings('ContactPage','Disabled');
                                else
                                    UpdateSettings('ContactPage','Enabled');

                                break;
                        }
                        break;
                }
                break;
            // …
        }

    }





}


?>

