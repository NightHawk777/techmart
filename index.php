<?php     
    session_start();
    ob_start();
    /* Loading all the classes in at once in the starting using __autoload().
        Classes folder contains the Route folder responsible for Routing operations.
        Controllers folder contains all the controllers we need in this fakin website.
        Models folder contains all the models this biatch needs. ;)
    */
    spl_autoload_register(function($class_name){
        if (file_exists('./classes/'.$class_name.'.php')){
            include './classes/'.$class_name.'.php';
        }
        
        if (file_exists('./controllers/'.$class_name.'.php')){
            include './controllers/'.$class_name.'.php';
        }
        
        if (file_exists('./models/'.$class_name.'.php')){
            include './models/'.$class_name.'.php';
        }
    });
    include './routes/routes.php';
?>