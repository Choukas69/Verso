<?php

namespace VFram\Persistence;

class Entity
{
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}