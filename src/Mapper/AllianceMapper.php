<?php

namespace App\Mapper;

use App\ApiResource\AllianceDto;
use App\Entity\Alliance;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AllianceMapper
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    public function dtoToEntity(AllianceDto $allianceDto) : Alliance
    {
        $json = $this->serializer->serialize($allianceDto, 'json');
        return $this->serializer->deserialize($json, Alliance::class, 'json');
    }

}