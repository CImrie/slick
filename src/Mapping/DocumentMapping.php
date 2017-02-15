<?php


namespace CImrie\Slick\Mapping;


abstract class DocumentMapping extends AbstractMapping
{
    public function isTransient()
    {
        return false;
    }
}