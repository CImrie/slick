<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Traits\RelationDiscriminatorMapping;

class EmbedDiscriminatorBuilder extends AbstractBuilder
{
    use RelationDiscriminatorMapping;

    public function __construct(ClassMetadataBuilder $metadataBuilder, $embed, $fieldName)
    {
        parent::__construct($metadataBuilder);
        $this->relation = $embed;
        $this->relationFieldName = $fieldName;
    }
}