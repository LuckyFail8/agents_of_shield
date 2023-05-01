<?php

namespace Models;

interface Person
{
    public function setId(int $id): self;
    public function getId(): int;

    public function setName(string $name): self;
    public function getName(): string;

    public function setLastName(string $lastName): self;
    public function getLastName(): string;

    public function setCountry(string|int $country): self;
    public function getCountry(): string;
}
