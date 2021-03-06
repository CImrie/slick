<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;

abstract class AbstractBuilder implements Builder
{
    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        $this->metadataBuilder = $metadataBuilder;
    }
}