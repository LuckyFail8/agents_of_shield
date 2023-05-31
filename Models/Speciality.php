<?php

namespace Models;

use Models\Model;

class Speciality extends Model
{
    private ?int $id = null;
    private ?string $name = null;
    private ?array $agent = null;
    private ?array $mission = null;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAgent(): ?array
    {
        return $this->agent;
    }
    public function setAgent(?array $agent): self
    {
        $this->agent = $agent;
        return $this;
    }

    public function getMission(): ?array
    {
        return $this->mission;
    }
    public function setMission(?array $mission): self
    {
        $this->mission = $mission;
        return $this;
    }
}
