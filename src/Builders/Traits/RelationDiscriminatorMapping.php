<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\ODM\Mapping\Builder;
use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Discriminator;
use CImrie\ODM\Mapping\Traits\DiscriminatorMap;

trait RelationDiscriminatorMapping
{
    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function field($name)
    {
        $this->discriminator->field($name);

        return $this;
    }

    public function with(array $map)
    {
        $this->discriminator->withMap($map);

        return $this;
    }

    public function setDefault($value)
    {
        $this->discriminator->setDefaultValue($value);

        return $this;
    }
}