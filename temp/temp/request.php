<?php

class Request
{
    private array $postData;
    private array $getData;

    public function __construct()
    {
        $this->postData = $_POST;
        $this->getData = $_GET;
        $this->sanitizeData();
    }

    public function getParam(string $key): string
    {
        if (array_key_exists($key, $this->getData)) {
            return $this->getData[$key];
        } elseif (array_key_exists($key, $this->postData)) {
            return $this->postData[$key];
        } else {
            return 'UNDEFINED KEY ERROR';
        }
    }

    private function sanitizeData()
    {
        // Sanitize data in $_GET and $_POST arrays if needed
        $this->getData = $this->sanitizeArray($this->getData);
        $this->postData = $this->sanitizeArray($this->postData);
    }

    private function sanitizeArray(array $data): array
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            $sanitizedKey = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            $sanitizedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $sanitizedData[$sanitizedKey] = $sanitizedValue;
        }
        return $sanitizedData;
    }
}
