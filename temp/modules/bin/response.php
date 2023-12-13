<?php

class HttpResponse
{
    private ArrayObject $data;

    public function __construct()
    {
        $this->data = new ArrayObject();
    }

    public function setAttribute($name, $data)
    {

        $this->data[$name] = $data;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }
}
