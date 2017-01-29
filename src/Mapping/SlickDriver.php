<?php


namespace CImrie\Slick\Mapping;

use CImrie\ODM\Configuration\MetaData\AbstractMetadata;
use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Slick;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata as OdmClassMetadata;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadataInfo;

class SlickDriver extends AbstractMetadata implements MappingDriver
{
    /**
     * @var Mapping[]
     */
    protected $mappings = [];

    /**
     * @var \Closure
     */
    protected $builderFactory;

    public function __construct()
    {
        $this->builderFactory = function(OdmClassMetadata $classMetadata)
        {
            return (new Slick(
                new ClassMetadataBuilder(
                    $classMetadata
                )
            ));
        };
    }

    public function resolve(array $settings)
    {
        //get the mapping files from the settings and map each one
        $mappingClasses = array_get($settings, 'mappings', []);
        foreach ($mappingClasses as $mappingClass) {
            /** @var Mapping $mapping */
            $mapping = new $mappingClass();
            $this->mappings[$mapping->mapFor()] = $mapping;
        }

        return $this;
    }

    public function loadMetadataForClass($className, ClassMetadata $metadata)
    {
        $this->mappings[$className]->map(
            $builder = $this->getBuilder($metadata)
        );

        $builder->build();

        return $this;
    }

    public function getAllClassNames()
    {
        return array_keys($this->mappings);
    }

    public function isTransient($className)
    {
        return $this->mappings[$className]->isTransient();
    }

    public function getBuilder(ClassMetadata $metadata)
    {
        $factory = $this->builderFactory;
        return $factory($metadata);
    }

    /**
     * @param \Closure $builderFactory
     * @return SlickDriver
     */
    public function setBuilderFactory(\Closure $builderFactory)
    {
        $this->builderFactory = $builderFactory;

        return $this;
    }
}