<?php
    /**
     * @uses phinx migrations instantiator
     * @return dbconnection for sql interface
     */

    require __DIR__."/Bootstrap/app.php";

    $config = $container['settings']['db'];

        return [
            "paths" => [
                "migrations" => "App/Migrations"
            ],

            "migration_base_class"=>"DealsManager\Migrations\Core\Migration",

            "templates"=>[

                "file"=>"App/Migrations/Core/MigrationStub.php"
            ],
    
            "environments" => [
                "default_migration_table" => "migrations",
                "default" => [
                    "adapter" => $config['driver'],
                    "host" => $config['host'],
                    "name" => $config['database'],
                    "user" => $config['username'],
                    "pass" => $config['password'],
                    "port" => $config['port']
                ]
            ]
        ];


?>