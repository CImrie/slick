<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Embeds\Many;
use CImrie\ODM\Mapping\Embeds\One;
use CImrie\Slick\Builders\Embedded\EmbedDiscriminatorBuilder;

trait DefaultEmbedMappings
{
    /**
     * @var Many | One
     */
    protected $embed;

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
        $this->embed->field($name);

        return $this;
    }

    public function target($class)
    {
        $this->embed->entity($class);

        return $this;
    }

    public function discriminate($field)
    {
        $this->metadataBuilder->enableSingleCollectionInheritance();
        $discriminatorBuilder = (new EmbedDiscriminatorBuilder($this->metadataBuilder, $this->embed, $this->fieldName));
        $discriminatorBuilder->field($field);

        return $discriminatorBuilder;
    }
}