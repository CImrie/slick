<?php


namespace CImrie\Slick;


use CImrie\ODM\Mapping\Index;
use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\EmbedBuilder;
use CImrie\Slick\Builders\FieldBuilder;
use CImrie\Slick\Builders\ReferenceBuilder;
use CImrie\Slick\Builders\Traits\DocumentProperties;
use CImrie\Slick\Builders\Traits\FieldAliases;

class DocumentBuilder extends AbstractBuilder
{
    use DocumentProperties, FieldAliases;

    /**
     * @var array
     */
    protected $builders = [];

    public function field($name)
    {
        $fieldBuilder = new FieldBuilder($this->metadataBuilder);
        $fieldBuilder->field($name);

        return $fieldBuilder;
    }

    public function reference()
    {
        $referenceBuilder = new ReferenceBuilder($this->metadataBuilder);

        return $referenceBuilder;
    }

    public function embed()
    {
        $embedBuilder = new EmbedBuilder($this->metadataBuilder);

        return $embedBuilder;
    }

    /**
     * @param Index[] $indexes
     * @return $this
     */
    public function indexes(array $indexes)
    {
        foreach($indexes as $index)
        {
            $this->metadataBuilder->addIndex($index);
        }

        return $this;
    }

    public function index()
    {
        $indexBuilder = new Index();

        return $indexBuilder;
    }

    public function addLifecycleCallback($events, $method)
    {
        if(!is_array($events))
        {
            $events = [$events];
        }

        foreach($events as $event)
        {
            $this->metadataBuilder->addLifecycleEventListener($event, $method);
        }

        return $this;
    }

    public function get()
    {
        return $this->metadataBuilder->getClassMetadata();
    }
}