<?php


namespace Tests\Unit\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Reference;
use CImrie\Slick\Builders\ReferenceBuilder;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Tests\Model\Documents\User;
use Tests\TestCase;

class ReferenceBuilderTest extends TestCase
{
    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    /**
     * @var ReferenceBuilder
     */
    protected $builder;

    protected function setUp()
    {
        parent::setUp();
        $this->metadataBuilder = new ClassMetadataBuilder(
            new ClassMetadata(User::class)
        );
        $this->builder = new ReferenceBuilder($this->metadataBuilder);
    }

    /**
     * @test
     */
    public function can_reference_one()
    {
        $reference = $this->builder->one(User::class);
        $this->assertBuilder(
            $reference
                ->field('name')
                ->mappedBy('user')
                ->cascade('all')
                ->removeOrphans()
                ->repositoryMethod('test')
        );

        $this->assertEquals('name', $this->metadata()->fieldMappings['name']['fieldName']);
        $this->assertEquals(User::class, $this->metadata()->fieldMappings['name']['targetDocument']);
        $this->assertEquals('user', $this->metadata()->fieldMappings['name']['mappedBy']);
        $this->assertTrue($this->metadata()->fieldMappings['name']['orphanRemoval']);
        $this->assertEquals('test', $this->metadata()->fieldMappings['name']['repositoryMethod']);
        $this->assertEquals(['all'], $this->metadata()->fieldMappings['name']['cascade']);

        $reference
            ->mappedBy(null)
            ->inversedBy('user');

        $this->assertEquals('user', $this->metadata()->fieldMappings['name']['inversedBy']);

        $reference->storeAsDbRefWithDbName();
        $this->assertEquals(Reference::DB_REF_WITH_DB_NAME, $this->metadata()->fieldMappings['name']['storeAs']);

        $reference->storeAsDbRefWithoutDbName();
        $this->assertEquals(Reference::DB_REF_WITHOUT_DB_NAME, $this->metadata()->fieldMappings['name']['storeAs']);

        $reference->storeAsId();
        $this->assertEquals(Reference::DB_REF_ID_ONLY, $this->metadata()->fieldMappings['name']['storeAs']);
    }

    /**
     * @test
     */
    public function can_reference_many()
    {
        $reference = $this->builder->many(User::class);
        $this->assertBuilder(
            $reference
                ->field('name')
                ->mappedBy('user')
                ->cascade('all')
                ->removeOrphans()
                ->discriminate('type')
                    ->setDefault('test_default')
        );

        $this->assertEquals('type', $this->metadata()->fieldMappings['name']['discriminatorField']);
        $this->assertEquals('test_default', $this->metadata()->fieldMappings['name']['defaultDiscriminatorValue']);
    }
}