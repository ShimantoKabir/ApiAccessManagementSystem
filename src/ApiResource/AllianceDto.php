<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\AllianceController;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

#[ApiResource(operations: [
    new Post(
        uriTemplate: '/api/alliances',
        controller: AllianceController::class,
        shortName: "Alliance",
        name: "save-alliance"
    )
])]
class AllianceDto
{
    /**
     * @var int
     */
    public int $id = 0;

    /**
     * @var string
     */
    #[NotBlank(message: "Label can't be empty!")]
    #[Type('string')]
    #[NotNull(message: "Label can't be null!")]
    public string $label;

    /**
     * @var array<ActionDto>
     */
    public array $actionList;
}