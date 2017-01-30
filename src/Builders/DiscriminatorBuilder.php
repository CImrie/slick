<?php


namespace CImrie\Slick\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Discriminator;

class DiscriminatorBuilder extends AbstractBuilder
{
    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->discriminator = new Discriminator();
    }

    /**
     * @param $name
     * @return $this
     */
    public function field($name)
    {
        $this->discriminator->field($name);

        return $this;
    }

    /**
     * @param array $map
     * @return $this
     */
    public function with(array $map)
    {
        $this->discriminator->withMap($map);

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function setDefault($key)
    {
        $this->discriminator->setDefaultValue($key);

        return $this;
    }

    public function build()
    {
        $this->metadataBuilder->setDiscriminator($this->discriminator);

        return $this;
    }
}