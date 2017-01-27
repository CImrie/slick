<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\References\DefaultReferenceMappings as Reference;
use CImrie\Slick\Builders\References\ReferenceDiscriminatorBuilder;

trait DefaultReferenceMappings
{
    /**
     * @var Reference | \CImrie\ODM\Mapping\References\Reference
     */
    protected $reference;

    /**
     * @var string
     */
    protected $fieldName;

    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;


    public function field($name)
    {
        $this->fieldName = $name;
        $this->reference->property($name);
        $this->updateMapping();

        return $this;
    }

    public function target($class)
    {
        $this->reference->entity($class);
        $this->updateMapping();

        return $this;
    }

    public function mappedBy($field)
    {
        $this->reference->mappedBy($field);
        $this->updateMapping();

        return $this;
    }

    public function inversedBy($field)
    {
        $this->reference->inversedBy($field);
        $this->updateMapping();

        return $this;
    }

    public function cascade($cascades)
    {
        $this->reference->cascade($cascades);
        $this->updateMapping();

        return $this;
    }

    public function removeOrphans()
    {
        $this->reference->removeOrphans();
        $this->updateMapping();

        return $this;
    }

    public function repositoryMethod($method)
    {
        $this->reference->repositoryMethod($method);
        $this->updateMapping();

        return $this;
    }

    public function storeAsDbRefWithDbName()
    {
        $this->reference->storeAsDbRefWithDbName();
        $this->updateMapping();

        return $this;
    }

    public function storeAsDbRefWithoutDbName()
    {
        $this->reference->storeAsDbRefWithoutDbName();
        $this->updateMapping();

        return $this;
    }

    public function storeAsId()
    {
        $this->reference->storeAsId();
        $this->updateMapping();

        return $this;
    }

    public function discriminate($field)
    {
        $this->metadataBuilder->enableSingleCollectionInheritance();
        $discriminatorBuilder = (new ReferenceDiscriminatorBuilder($this->metadataBuilder, $this->reference, $this->fieldName));
        $discriminatorBuilder->field($field);

        return $discriminatorBuilder;
    }

    protected function updateMapping()
    {
        $this->metadataBuilder->getClassMetadata()->fieldMappings[$this->fieldName] = $this->reference->asArray();
    }
}