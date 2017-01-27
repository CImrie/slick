<?php


namespace CImrie\Slick;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;

class Slick
{
    /**
     * documentClass => ClassMetadataBuilder map
     * @var array
     */
    protected $metadatas = [];

    public function builder($documentClass)
    {
        $classMetadataBuilder = new ClassMetadataBuilder(
            new ClassMetadata($documentClass)
        );

        $this->metadatas[$documentClass] = $classMetadataBuilder;

        return new DocumentBuilder($classMetadataBuilder);
    }
}