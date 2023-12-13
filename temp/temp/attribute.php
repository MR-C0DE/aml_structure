<?php

class HttpAttribute
{
    private array $attributes = [];

    public function setAttribute(string $name, $data): void
    {
        $this->attributes[$name] = $data;
    }

    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes[$name] ?? $default;
    }

    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    public function removeAttribute(string $name): void
    {
        if ($this->hasAttribute($name)) {
            unset($this->attributes[$name]);
        }
    }

    public function getAllAttributes(): array
    {
        return $this->attributes;
    }
}
