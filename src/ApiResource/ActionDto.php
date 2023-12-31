<?php

namespace App\ApiResource;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

/**
 *
 */
class ActionDto
{
    /**
     * @var int
     */
    private int $id = 0;

    /**
     * @var string
     */
    #[NotBlank(message: "Route can't be empty!")]
    #[Type('string')]
    #[NotNull(message: "Route can't be null!")]
    private string $route;

    /**
     * @var string
     */
    #[NotBlank(message: "Method can't be empty!")]
    #[Type('string')]
    #[NotNull(message: "Method can't be null!")]
    private string $method;
}