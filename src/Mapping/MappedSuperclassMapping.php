<?php


namespace CImrie\Slick\Mapping;


use CImrie\Slick\Slick;

abstract class MappedSuperclassMapping extends AbstractMapping
{
    public function map(Slick $builder)
    {
        $builder->mappedSuperclass();
    }

    public function isTransient()
    {
        return false;
    }
}