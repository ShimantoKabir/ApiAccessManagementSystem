<?php

namespace App\ApiResource;

use DateTime;

class ActionDto
{
    private int $id = 0;
    private string $route;
    private string $method;
    private DateTime $createdAt;
    private DateTime $updatedAt;
}