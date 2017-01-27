<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\ODM\Mapping\Builder;
use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Traits\DiscriminatorMap;

trait RelationDiscriminatorMapping
{
    /**
     * @var DiscriminatorMap | Builder
     */
    protected $relation;

    /**
     * @var string
     */
    protected $discriminatorFieldName;

    /**
     * @var string
     */
    protected $relationFieldName;

    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    public function field($field)
    {
        $this->relation->discriminateOn($field);
        $this->discriminatorFieldName = $field;
        $this->updateMapping();

        return $this;
    }

    public function with(array $map)
    {
        $this->relation->discriminateUsing($map);
        $this->updateMapping();

        return $this;
    }

    public function setDefault($key)
    {
        $this->relation->discriminateOn($this->discriminatorFieldName, $key);
        $this->updateMapping();

        return $this;
    }

    protected function updateMapping()
    {
        $this->metadataBuilder->getClassMetadata()->fieldMappings[$this->relationFieldName] = $this->relation->asArray();

        return $this;
    }
}