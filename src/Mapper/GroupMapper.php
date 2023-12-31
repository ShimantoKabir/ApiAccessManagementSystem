<?php

namespace App\Mapper;

use App\ApiResource\GroupDto;
use App\Entity\Group;
use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GroupMapper
{
    private Serializer $serializer;
    private ActionRepository $actionRepository;

    public function __construct(ActionRepository $actionRepository)
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $this->actionRepository = $actionRepository;
    }

    public function dtoToEntity(GroupDto $groupDto) : Group
    {
        $json = $this->serializer->serialize($groupDto, 'json');
        return $this->serializer->deserialize($json, Group::class, 'json');
    }

}