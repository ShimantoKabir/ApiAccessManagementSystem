<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

class Group
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $label;



}