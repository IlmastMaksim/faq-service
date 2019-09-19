<?php

    session_start();
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 1);
    
    require 'vendor/autoload.php';
    require 'data/db.php';
    require_once 'config/database.php';

    $loader = new Twig_Loader_Filesystem('app/views');
    $twig = new Twig_Environment($loader, ['cache' => false]);

    function getUrlId() {
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $link = "https"; 
        }
        else {
            $link = "http";
        } 
        
        $link .= "://"; 
    
        $link .= $_SERVER['HTTP_HOST']; 
        
        $link .= $_SERVER['REQUEST_URI']; 

        $pos = strrpos($link, '/');
        return $id = $pos === false ? $link : substr($link, $pos + 1);
    }


    $app = new \Slim\App( 
        [
            'settings' => [
            'displayErrorDetails' => true
            ],
            'db' =>  Database::connect(HOST, DBNAME, USERNAME, PASSWORD),
            'view' => $twig,
            'urlId' => getUrlId()
        ]
    );

    require 'config/routes.php';

    $app->run()
?>
