<?php


namespace CImrie\Slick\Builders\References;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Builder;
use CImrie\Slick\Builders\Traits\DefaultReferenceMappings;

class Many extends AbstractBuilder implements Builder
{
    use DefaultReferenceMappings;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->reference = new \CImrie\ODM\Mapping\References\Many();
    }

    public function build()
    {
        $this->metadataBuilder->addReference($this->reference);
    }
}