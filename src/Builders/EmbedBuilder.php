<?php


namespace CImrie\Slick\Builders;


use CImrie\Slick\Builders\Embedded\Many;
use CImrie\Slick\Builders\Embedded\One;

class EmbedBuilder extends AbstractBuilder
{
    public function one($target)
    {
        return (new One($this->metadataBuilder))->target($target);
    }

    public function many($target)
    {
        return (new Many($this->metadataBuilder))->target($target);
    }
}