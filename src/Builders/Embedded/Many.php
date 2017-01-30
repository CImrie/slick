<?php


namespace CImrie\Slick\Builders\Embedded;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Discriminator;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Builder;
use CImrie\Slick\Builders\Traits\DefaultEmbedMappings;

class Many extends AbstractBuilder implements Builder
{
    use DefaultEmbedMappings;

    /**
     * @var \CImrie\ODM\Mapping\Embeds\Many
     */
    protected $embed;

    /**
     * @var Discriminator
     */
    protected $discriminator;

    public function __construct(ClassMetadataBuilder $metadataBuilder)
    {
        parent::__construct($metadataBuilder);
        $this->embed = new \CImrie\ODM\Mapping\Embeds\Many();
        $this->discriminator = $this->embed->discriminate();
    }

    public function build()
    {
        return $this->metadataBuilder->addManyEmbeddedDocument($this->embed);
    }
}