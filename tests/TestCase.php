<?php


namespace Tests;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\AbstractBuilder;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    protected function metadata()
    {
        return $this->metadataBuilder->getClassMetadata();
    }

    protected function assertBuilder($builder)
    {
        $this->assertInstanceOf(AbstractBuilder::class, $builder);

        return $builder;
    }
}