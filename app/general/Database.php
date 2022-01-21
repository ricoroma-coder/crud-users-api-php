<?php

namespace App\General;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct()
    {
        try
        {
            $capsule = new Capsule();
            $capsule->addConnection([
                "driver" => $_ENV['DBDRIVER'],
                "host" => $_ENV['DBHOST'],
                "database" => $_ENV['DBNAME'],
                "username" => $_ENV['DBUSER'],
                "password" => empty($_ENV['DBPASS']) ? '' : $_ENV['DBPASS'],
                "charset" => "utf8",
                "collation" => "utf8_unicode_ci",
                "prefix" => "",
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        }
        catch (\Exception $e)
        {
            response()->json(['success' => false, 'message' => $e->getMessage()], $e->getCode());
        }
    }
}
