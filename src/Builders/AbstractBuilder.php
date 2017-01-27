<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;

abstract class AbstractBuilder
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