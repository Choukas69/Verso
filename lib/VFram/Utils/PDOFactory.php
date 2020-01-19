<?php

namespace VFram\Utils;

use PDO;

class PDOFactory
{
    public static function getConnection(): PDO
    {
        // TODO : GetMethod credentials form file config
        $db = new PDO("mysql:host=localhost;dbname=Test", "root", "xh3792j5");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        return $db;
    }
}