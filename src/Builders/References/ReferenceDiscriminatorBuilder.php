<?php


namespace CImrie\Slick\Builders\References;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\References\DefaultReferenceMappings;
use CImrie\ODM\Mapping\References\Reference;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Traits\RelationDiscriminatorMapping;

class ReferenceDiscriminatorBuilder extends AbstractBuilder
{
    use RelationDiscriminatorMapping;

    /**
     * @var Reference | DefaultReferenceMappings
     */
    protected $relation;

    /**
     * @var string
     */
    protected $discriminatorFieldName;

    /**
     * @var array
     */
    protected $mapping = [];

    /**
     * @var string
     */
    protected $relationFieldName;

    /**
     * ReferenceDiscriminatorBuilder constructor.
     * @param ClassMetadataBuilder $metadataBuilder
     * @param Reference | DefaultReferenceMappings $reference
     * @param $referenceFieldName
     */
    public function __construct(ClassMetadataBuilder $metadataBuilder, Reference $reference, $referenceFieldName)
    {
        parent::__construct($metadataBuilder);
        $this->relation = $reference;
        $this->relationFieldName = $referenceFieldName;
    }


}