<?php

namespace App\Mapper;

use App\ApiResource\GroupDto;
use App\Entity\Group;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GroupMapper
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    public function dtoToEntity(GroupDto $groupDto) : Group
    {

        $json = $this->serializer->serialize($groupDto, 'json');
        return $this->serializer->deserialize($json, Group::class, 'json');
    }

}