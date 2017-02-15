<?php


namespace CImrie\Slick\Mapping;


use CImrie\Slick\Slick;

abstract class EmbeddedDocumentMapping extends AbstractMapping
{
    public function map(Slick $builder)
    {
        $builder->embedded();
        return parent::map($builder);
    }
}