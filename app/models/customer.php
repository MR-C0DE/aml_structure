<?php

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private DateTimeImmutable $registrationDate;

    public function __construct(int $id, string $firstName, string $lastName, string $email, DateTimeImmutable $registrationDate)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->registrationDate = $registrationDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRegistrationDate(): DateTimeImmutable
    {
        return $this->registrationDate;
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
