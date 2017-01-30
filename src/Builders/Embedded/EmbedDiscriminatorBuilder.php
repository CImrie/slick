<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Discriminator;
use CImrie\ODM\Mapping\Embeds\Many;
use CImrie\ODM\Mapping\Embeds\One;
use CImrie\Slick\Builders\Traits\RelationDiscriminatorMapping;

class EmbedDiscriminatorBuilder
{
    use RelationDiscriminatorMapping;

    /**
     * @var One | Many
     */
    protected $embed;

    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function __construct($embed)
    {
        $this->embed = $embed;
        $this->discriminator = $this->embed->discriminate();
    }
}