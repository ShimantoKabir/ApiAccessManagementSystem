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
    private int $id;

    #[ORM\Column(length: 255)]
    private string $route;

    #[ORM\Column(length: 255)]
    private string $method;

    #[ORM\Column(type: 'datetime')]
    protected DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    protected DateTime $updatedAt;

    public function setUpdatedAt(): void
    {
        $this->updatedAt->modify("now");
    }
}