<?php

namespace App\Mapper;

use App\ApiResource\AllianceDto;
use App\Entity\Alliance;
use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AllianceMapper
{
    private Serializer $serializer;
    private ActionRepository $actionRepository;

    public function __construct(ActionRepository $actionRepository)
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $this->actionRepository = $actionRepository;
    }

    public function dtoToEntity(AllianceDto $groupDto) : Alliance
    {
        $json = $this->serializer->serialize($groupDto, 'json');
        return $this->serializer->deserialize($json, Alliance::class, 'json');
    }

}