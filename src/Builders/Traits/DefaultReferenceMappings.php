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


    /**
     * @param $name
     * @return $this
     */
    public function field($name)
    {
        $this->fieldName = $name;
        $this->reference->property($name);

        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function target($class)
    {
        $this->reference->entity($class);

        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function mappedBy($field)
    {
        $this->reference->mappedBy($field);

        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function inversedBy($field)
    {
        $this->reference->inversedBy($field);

        return $this;
    }

    /**
     * @param $cascades
     * @return $this
     */
    public function cascade($cascades)
    {
        $this->reference->cascade($cascades);

        return $this;
    }

    /**
     * @return $this
     */
    public function removeOrphans()
    {
        $this->reference->removeOrphans();

        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function repositoryMethod($method)
    {
        $this->reference->repositoryMethod($method);

        return $this;
    }

    /**
     * @return $this
     */
    public function storeAsDbRefWithDbName()
    {
        $this->reference->storeAsDbRefWithDbName();

        return $this;
    }

    /**
     * @return $this
     */
    public function storeAsDbRefWithoutDbName()
    {
        $this->reference->storeAsDbRefWithoutDbName();

        return $this;
    }

    /**
     * @return $this
     */
    public function storeAsId()
    {
        $this->reference->storeAsId();

        return $this;
    }

    /**
     * @param $field
     * @return ReferenceDiscriminatorBuilder
     */
    public function discriminate($field)
    {
        $this->metadataBuilder->enableSingleCollectionInheritance();
        $discriminatorBuilder = (new ReferenceDiscriminatorBuilder($this->reference));
        $discriminatorBuilder->field($field);

        return $discriminatorBuilder;
    }
}