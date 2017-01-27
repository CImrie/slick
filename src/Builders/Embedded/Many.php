<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Traits\DefaultEmbedMappings;

class Many extends AbstractBuilder
{
    use DefaultEmbedMappings;

    /**
     * @var \CImrie\ODM\Mapping\Embeds\Many
     */
    protected $embed;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->embed = new \CImrie\ODM\Mapping\Embeds\Many();
    }
}