<?php


namespace CImrie\Slick\Builders\References;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Traits\DefaultReferenceMappings;

class One extends AbstractBuilder
{
    use DefaultReferenceMappings;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->reference = new \CImrie\ODM\Mapping\References\One();
    }
}