<?php

    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    $DB_CONFIG['host'] = $hostname;
    $DB_CONFIG['database'] = $database;
    $DB_CONFIG['username'] = $username;
    $DB_CONFIG['password'] = $password;


?>