<?php


namespace CImrie\Slick\Builders;


use CImrie\Slick\Builders\References\Many;
use CImrie\Slick\Builders\References\One;
use CImrie\Slick\Builders\Traits\DecoratedBuilderHelpers;

class ReferenceBuilder extends AbstractBuilder
{
    use DecoratedBuilderHelpers;

    /**
     * @param $targetClass
     * @return One | Builder
     */
    public function one($targetClass)
    {
        return $this->builder((new One($this->metadataBuilder))->target($targetClass));
    }

    /**
     * @param $targetClass
     * @return Many | Builder
     */
    public function many($targetClass)
    {
        return $this->builder((new Many($this->metadataBuilder))->target($targetClass));
    }
}