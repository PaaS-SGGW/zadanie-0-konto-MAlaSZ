<?php

    require_once(substr(__DIR__,0,strrpos(__DIR__,'application')).'router.php');
    require_once Router::$Models['User'];
    require_once Router::$Config['Database'];
    require_once Router::$Config['Language'];
    session_start();

    function Login($Login, $Password) {
        global $DB_CONFIG;
        try {
            $db = new PDO('mysql:host=' . $DB_CONFIG['host'] . ';dbname=' . $DB_CONFIG['database'].';charset=utf8', $DB_CONFIG['username'], $DB_CONFIG['password']);
            $Query = $db->prepare("SELECT * from users WHERE Login = ?");
            $Query->execute(array($Login));

            $Candidate = $Query->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
            $Ids = array_keys($Candidate);
            if ($Candidate && count($Candidate) == 1 && count($Candidate[$Ids[0]]) == 1)
            {

                $User = new User($Ids[0],$Candidate[$Ids[0]][0]['Name'], $Candidate[$Ids[0]][0]['Login'],$Candidate[$Ids[0]][0]['Password'],$Candidate[$Ids[0]][0]['Salt'], $Candidate[$Ids[0]][0]['Language']);
                if($User && $User->VerifyPassword($Password)) {
                    session_start();
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['User'] = $User;
                    $_SESSION['Lang'] = $User->Language;
                    Language::SetLang($User->Language);
                    echo $User->Id;
                    echo "OK";
                }

                else
                    echo "ERROR";
            }
            else
                echo "ERROR";
        }
        catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }




    }

?>