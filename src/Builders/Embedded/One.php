<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Builder;
use CImrie\Slick\Builders\Traits\DefaultEmbedMappings;

class One extends AbstractBuilder implements Builder
{
    use DefaultEmbedMappings;

    /**
     * @var \CImrie\ODM\Mapping\Embeds\One
     */
    protected $embed;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->embed = new \CImrie\ODM\Mapping\Embeds\One();
    }

    public function build()
    {
        return $this->metadataBuilder->addEmbeddedDocument($this->embed);
    }
}