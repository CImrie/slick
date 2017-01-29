<?php


namespace CImrie\Slick\Builders;


use CImrie\Slick\Builders\Embedded\Many;
use CImrie\Slick\Builders\Embedded\One;
use CImrie\Slick\Builders\Traits\DecoratedBuilderHelpers;

class EmbedBuilder extends AbstractBuilder
{
    use DecoratedBuilderHelpers;

    public function one($target)
    {
        $builder =(new One($this->metadataBuilder))->target($target);

        return $this->builder($builder);
    }

    public function many($target)
    {
        $builder = (new Many($this->metadataBuilder))->target($target);

        return $this->builder($builder);
    }
}