<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Index;

class IndexBuilder extends Index implements Builder
{
    protected $metadataBuilder;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        $this->metadataBuilder = $metadataBuilder;
    }

    public function build()
    {
        return $this->metadataBuilder->addIndex($this);
    }

}