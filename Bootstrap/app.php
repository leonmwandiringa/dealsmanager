<?php
    /**
     * autoloading app
     * @author Leon mwandirnga
     * @uses bostrap the app ready to run
     * @og No need or talk lets do this - cite `SF5 Guile`
     */

    require __DIR__."/../vendor/autoload.php";

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    
    
    try {
        (new Dotenv\Dotenv(__DIR__ . '/../'))->load();

    } catch (Dotenv\Exception\InvalidPathException $e) {
        
    }

    
    session_start();
    $app = new Slim\App([

        "settings"=>[

            "displayErrorDetails"=>getenv("DISPLAY_ERRORS"),
            "db"=>[
                "database"=>getenv("DB_NAME"),
                "host"=>getenv("HOST"),
                "username"=>getenv("DB_NAME"),
                "port"=>getenv("DB_PORT"),
                "charset"=>getenv("DB_CHARSET"),
                "password"=>getenv("DB_PASSWORD"),
                "driver"=>getenv("DB_DRIVER"),
                "collation"=>getenv("DB_COLLATION")
            ],
            "jwt"=>[
                
                "secret"=>getenv("JWTSECRET")
            ]
        ]

    ]);

    require __DIR__."/dependancy.php";
    require __DIR__."/database.php";
    require __DIR__."/../Routes/web.php";


?>