<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Endpoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public int $id;

    #[ORM\Column(length: 255)]
    public string $route;

    #[ORM\Column(length: 255)]
    public string $method;

    #[ORM\Column(type: 'datetime')]
    public DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    public DateTime $updatedAt;

    public function setUpdatedAt(): void
    {
        $this->updatedAt->modify("now");
    }

    public function setDatetime(): void
    {
        $this->updatedAt->modify("now");
        $this->createdAt->modify("now");
    }
}