<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;

class Many extends AbstractBuilder
{
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