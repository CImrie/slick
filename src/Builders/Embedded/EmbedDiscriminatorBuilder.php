<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\Traits\RelationDiscriminatorMapping;

class EmbedDiscriminatorBuilder
{
    use RelationDiscriminatorMapping;

    public function __construct(ClassMetadataBuilder $metadataBuilder, $embed, $fieldName)
    {
        $this->metadataBuilder = $metadataBuilder;
        $this->relation = $embed;
        $this->relationFieldName = $fieldName;
    }
}