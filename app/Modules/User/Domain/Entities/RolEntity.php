<?php

namespace Modules\User\Domain\Entities;

class RolEntity
{
    public int $rolID;
    public string $nombreRol;
    public ?\DateTime $createdAt;
    public ?\DateTime $updatedAt;

    public function __construct(
        int $rolID,
        string $nombreRol,
        ?\DateTime $createdAt = null,
        ?\DateTime $updatedAt = null
    ) {
        $this->rolID = $rolID;
        $this->nombreRol = $nombreRol;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
}
