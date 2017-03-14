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

    public function useAddToSetStorageStrategy()
    {
        $this->embed->useAddToSetStorageStrategy();

        return $this;
    }

    public function usePushAllStorageStrategy()
    {
        $this->embed->usePushAllStorageStrategy();

        return $this;
    }

    public function useSetStorageStrategy()
    {
        $this->embed->useSetStorageStrategy();

        return $this;
    }

    public function useSetArrayStorageStrategy()
    {
        $this->embed->useSetArrayStorageStrategy();

        return $this;
    }

    public function useAtomicSetStorageStrategy()
    {
        $this->embed->useAtomicSetStorageStrategy();

        return $this;
    }

    public function useAtomicSetArrayStorageStrategy()
    {
        $this->embed->useAtomicSetArrayStorageStrategy();

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