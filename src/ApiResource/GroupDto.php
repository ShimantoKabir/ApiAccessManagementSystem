<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\GroupController;
use DateTime;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

#[ApiResource(operations: [
    new Post(
        uriTemplate: '/api/groups',
        controller: GroupController::class,
        shortName: "Group",
        name: "save-group"
    )
])]
class GroupDto
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
     * @var array<int>
     */
    public array $actionIds;

    /**
     * @var DateTime
     */
    public DateTime $createdAt;

    /**
     * @var DateTime
     */
    public DateTime $updatedAt;
}