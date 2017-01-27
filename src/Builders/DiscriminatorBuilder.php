<?php


namespace CImrie\Slick\Builders;


class DiscriminatorBuilder extends AbstractBuilder
{
    public function field($name)
    {
        $this->metadataBuilder->setDiscriminatorField($name);

        return $this;
    }

    public function with(array $map)
    {
        foreach($map as $alias => $class)
        {
            $this->metadataBuilder->addDiscriminatorMapping($alias, $class);
        }

        return $this;
    }

    public function setDefault($key)
    {
        $this->metadataBuilder->setDefaultDiscriminatorKey($key);

        return $this;
    }
}