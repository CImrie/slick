<?php


namespace Tests\Unit;


use CImrie\Slick\Slick;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadataInfo;
use Tests\Model\Documents\User;

class SlickTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_build_a_class_metadata_instance_for_a_document()
    {
        $slick = new Slick();
        $document = User::class;

        $builder = $slick->builder($document);

        $this->assertInstanceOf(ClassMetadataInfo::class, $builder->get());
    }
}