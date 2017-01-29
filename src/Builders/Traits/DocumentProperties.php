<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\DiscriminatorBuilder;

trait DocumentProperties
{
    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    public function mappedSuperclass()
    {
        $this->metadataBuilder->setMappedSuperclass();

        return $this;
    }

    public function embedded()
    {
        $this->metadataBuilder->setEmbedded();

        return $this;
    }

    public function collectionName($name)
    {
        $this->metadataBuilder->setCollectionName($name);

        return $this;
    }

    public function writeConcern($writeConcernString)
    {
        $this->metadataBuilder->setWriteConcern($writeConcernString);

        return $this;
    }

    public function singleCollectionInheritance()
    {
        $this->metadataBuilder->enableSingleCollectionInheritance();

        return $this;
    }

    public function collectionPerClassInheritance()
    {
        $this->metadataBuilder->enableCollectionPerClassInheritance();

        return $this;
    }

    public function discriminate($field)
    {
        $discriminatorBuilder = new DiscriminatorBuilder($this->metadataBuilder);
        $discriminatorBuilder->field($field);
        $this->addBuilder($discriminatorBuilder);

        return $discriminatorBuilder;
    }

    public function trackChangesImplicitly()
    {
        $this->metadataBuilder->setImplicitChangeTracking();

        return $this;
    }

    public function trackChangesExplicitly()
    {
        $this->metadataBuilder->setExplicitChangeTracking();

        return $this;
    }

    public function trackChangesWithNotification()
    {
        $this->metadataBuilder->setNotifyChangeTracking();

        return $this;
    }

    public function shardKey(array $keys, array $options = [])
    {
        $this->metadataBuilder->setShardKey($keys, $options);

        return $this;
    }

    public function allowReadFromSlaves($truthy = true)
    {
        $this->metadataBuilder->setSlaveOkay($truthy);

        return $this;
    }

    public function version()
    {
        $this->metadataBuilder->version(true);

        return $this;
    }

    public function repository($repositoryClass)
    {
        $this->metadataBuilder->setCustomRepository($repositoryClass);

        return $this;
    }
}