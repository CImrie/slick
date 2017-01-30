<?php


namespace CImrie\Slick\Builders\References;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\References\DefaultReferenceMappings;
use CImrie\ODM\Mapping\References\Many;
use CImrie\ODM\Mapping\References\Reference;
use CImrie\Slick\Builders\Traits\RelationDiscriminatorMapping;

class ReferenceDiscriminatorBuilder
{
    use RelationDiscriminatorMapping;

    /**
     * @var One | Many
     */
    protected $reference;

    /**
     * ReferenceDiscriminatorBuilder constructor.
     * @param Reference | DefaultReferenceMappings $reference
     * @internal param ClassMetadataBuilder $metadataBuilder
     * @internal param $referenceFieldName
     */
    public function __construct(Reference $reference)
    {
        $this->reference = $reference;
        $this->discriminator = $this->reference->discriminate();
    }


}