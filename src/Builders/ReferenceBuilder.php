<?php


namespace CImrie\Slick\Builders;


use CImrie\Slick\Builders\References\Many;
use CImrie\Slick\Builders\References\One;
use CImrie\Slick\Builders\Traits\DecoratedBuilderHelpers;

class ReferenceBuilder extends AbstractBuilder
{
    use DecoratedBuilderHelpers;

    public function one($targetClass)
    {
        return (new One($this->metadataBuilder))->target($targetClass);
    }

    public function many($targetClass)
    {
        return (new Many($this->metadataBuilder))->target($targetClass);
    }
}