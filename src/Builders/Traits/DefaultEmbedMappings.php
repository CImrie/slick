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

    /**
     * @param $name
     * @return $this
     */
    public function field($name)
    {
        $this->fieldName = $name;
        $this->embed->field($name);

        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function target($class)
    {
        $this->embed->entity($class);

        return $this;
    }

    /**
     * @param $field
     * @return EmbedDiscriminatorBuilder | RelationDiscriminatorMapping
     */
    public function discriminate($field)
    {
        $discriminatorBuilder = (new EmbedDiscriminatorBuilder($this->embed));
        $discriminatorBuilder->field($field);

        return $discriminatorBuilder;
    }
}