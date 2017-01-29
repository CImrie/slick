<?php


namespace CImrie\Slick\Builders;


class DiscriminatorBuilder extends AbstractBuilder
{
    protected $field;
    protected $map;
    protected $key;

    public function field($name)
    {
        $this->field = $name;

        return $this;
    }

    public function with(array $map)
    {
        $this->map = $map;

        return $this;
    }

    public function setDefault($key)
    {
        $this->key = $key;

        return $this;
    }

    public function build()
    {
        if($this->field)
        {
            $this->metadataBuilder->setDiscriminatorField($this->field);
        }

        if($this->map)
        {
            foreach($this->map as $alias => $class)
            {
                $this->metadataBuilder->addDiscriminatorMapping($alias, $class);
            }
        }

        if($this->key)
        {
            $this->metadataBuilder->setDefaultDiscriminatorKey($this->key);
        }

        return $this->metadataBuilder;
    }
}