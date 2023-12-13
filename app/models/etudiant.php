<?php

class Person
{
    private string $name;

    public function __construct(string $name = "Inc")
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
