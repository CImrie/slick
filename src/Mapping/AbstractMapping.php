<?php


namespace CImrie\Slick\Mapping;


abstract class AbstractMapping implements Mapping
{
    public function isTransient()
    {
        return true;
    }
}