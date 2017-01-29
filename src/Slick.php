<?php


namespace CImrie\Slick;


use CImrie\Slick\Builders\AbstractBuilder;
use CImrie\Slick\Builders\Builder;
use CImrie\Slick\Builders\EmbedBuilder;
use CImrie\Slick\Builders\FieldBuilder;
use CImrie\Slick\Builders\IndexBuilder;
use CImrie\Slick\Builders\ReferenceBuilder;
use CImrie\Slick\Builders\Traits\DocumentProperties;
use CImrie\Slick\Builders\Traits\FieldAliases;

class Slick extends AbstractBuilder
{
    use DocumentProperties, FieldAliases;

    /**
     * @var array
     */
    protected $builders = [];

    /**
     * @param $name
     * @return FieldBuilder
     */
    public function field($name)
    {
        $fieldBuilder = new FieldBuilder($this->metadataBuilder);
        $fieldBuilder->field($name);

        $this->addBuilder($fieldBuilder);

        return $fieldBuilder;
    }

    public function reference()
    {
        $referenceBuilder = new ReferenceBuilder($this->metadataBuilder);
        $this->addBuilder($referenceBuilder);

        return $referenceBuilder;
    }

    public function embed()
    {
        $embedBuilder = new EmbedBuilder($this->metadataBuilder);
        $this->addBuilder($embedBuilder);

        return $embedBuilder;
    }

    public function index()
    {
        $indexBuilder = new IndexBuilder($this->metadataBuilder);
        $this->addBuilder($indexBuilder);

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

    public function build()
    {
        foreach($this->builders as $builder)
        {
            $builder->build();
        }

        return $this;
    }

    protected function addBuilder(Builder $builder)
    {
        $this->builders[] = $builder;

        return $this;
    }
}