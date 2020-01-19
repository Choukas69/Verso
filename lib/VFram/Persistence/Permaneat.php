<?php

namespace VFram\Persistence;

use PDO;

class Permaneat
{
    private PDO $db;
    private array $managers;

    /**
     * Permaneat constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getManager(String $name)
    {
        if (!isset($this->managers[$name])) {
            $manager = 'App\\Model\\' . $name . 'Manager';
            $this->managers[$name] = new $manager($this->db);
        }

        return $this->managers[$name];
    }
}