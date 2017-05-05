<?php


namespace CImrie\Slick\Builders;


use CImrie\Slick\Builders\Embedded\Many;
use CImrie\Slick\Builders\Embedded\One;
use CImrie\Slick\Builders\Traits\DecoratedBuilderHelpers;
use CImrie\Slick\Builders\Traits\DefaultEmbedMappings;

class EmbedBuilder extends AbstractBuilder
{
    use DecoratedBuilderHelpers;

    /**
     * @param $target
     * @return One | Builder | DefaultEmbedMappings
     */
    public function one($target)
    {
        $builder =(new One($this->metadataBuilder))->target($target);

        return $this->builder($builder);
    }

    /**
     * @param $target
     * @return Many | Builder | DefaultEmbedMappings
     */
    public function many($target)
    {
        $builder = (new Many($this->metadataBuilder))->target($target);

        return $this->builder($builder);
    }
}