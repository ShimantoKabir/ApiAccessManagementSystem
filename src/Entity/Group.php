<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;

#[ORM\Entity]
class Group
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $label;

    /**
     * Many Groups have Many Actions.
     * @var Collection<int, Action>
     */
    #[JoinTable(name: 'groups_actions')]
    #[JoinColumn(name: 'group_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'action_id', referencedColumnName: 'id', unique: true)]
    #[ManyToMany(targetEntity: Action::class)]
    private Collection $actions;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: "datetime")]
    private DateTime $createdAt;

    /**
     * @var DateTime
     */
    #[ORM\Column(type: "datetime")]
    private DateTime $updatedAt;

    /**
     * Ignored property
     *
     * @var array<int>
     */
    public array $actionIds;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    /**
     * @param Collection<Action> $actions
     */
    public function setActions(Collection $actions): void
    {
        $this->actions = $actions;
    }

    public function __construct()
    {
        $now = new DateTime();

        $this->createdAt = $now;
        $this->updatedAt = $now;

        $this->actions = new ArrayCollection();
    }
}