<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Patch;
use App\Controller\AllianceController;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

#[ApiResource(operations: [
    new Delete(
        uriTemplate: '/api/alliances/actions',
        controller: AllianceController::class,
        shortName: "AllianceAction",
        name: "delete-action-from-alliances"
    ),
    new Patch(
        uriTemplate: '/api/alliances/actions',
        controller: AllianceController::class,
        shortName: "AllianceAction",
        name: "add-action-from-alliances"
    )
])]
class AllianceActionDto
{
    /**
     * @var int
     */
    #[NotBlank(message: "Id can't be empty!")]
    #[Type('integer')]
    #[NotNull(message: "Id can't be null!")]
    #[NotEqualTo(value: 0)]
    public int $id;

    /**
     * @var array<int>
     */
    #[Type('array')]
    #[Count(
        min: 1,
        minMessage: 'You must specify at least one id!'
    )]
    #[NotNull(message: "Action ids can't be null!")]
    public array $actionIds;
}