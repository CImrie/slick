<?php


namespace Tests\Unit;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\ODM\Mapping\Index;
use CImrie\Slick\Slick;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Tests\Model\Documents\User;
use Tests\TestCase;
use Tests\Unit\DocumentBuilderTestTraits\FieldAliasesTests;

class DocumentBuilderTest extends TestCase
{
    use FieldAliasesTests;

    /**
     * @var ClassMetadataBuilder
     */
    protected $metadataBuilder;

    /**
     * @var Slick
     */
    protected $builder;

    protected function setUp()
    {
        parent::setUp();
        $this->metadataBuilder = new ClassMetadataBuilder(new ClassMetadata(User::class));
        $this->builder = new Slick($this->metadataBuilder);
    }

    /**
     * @test
     */
    public function can_make_mapped_superclass()
    {
        $this->assertBuilder($this->builder->mappedSuperclass()->build());

        $this->assertTrue($this->metadata()->isMappedSuperclass);
    }

    /**
     * @test
     */
    public function can_make_embedded_document()
    {
        $this->assertBuilder($this->builder->embedded()->build());
        $this->assertTrue($this->metadata()->isEmbeddedDocument);
    }

    /**
     * @test
     */
    public function can_set_collection_name()
    {
        $this->assertBuilder($this->builder->collectionName('test_col'));
        $this->assertEquals('test_col', $this->metadata()->collection);
    }

    /**
     * @test
     */
    public function can_set_write_concern()
    {
        $this->assertBuilder($this->builder->writeConcern('w:1'));

        $this->assertEquals('w:1', $this->metadata()->writeConcern);
    }

    /**
     * @test
     */
    public function can_set_discriminator_field()
    {
        $this->assertBuilder(
            $this->builder
                ->singleCollectionInheritance()
                ->discriminate('type')
        );

        $this->builder->build();

        $this->assertEquals('type', $this->metadata()->discriminatorField);
    }

    /**
     * @test
     */
    public function can_override_discriminator_mapping()
    {
        $this->assertBuilder(
            $this->builder
                ->singleCollectionInheritance()
                ->discriminate('type')
                ->with(['foo' => User::class])
        );

        $this->builder->build();

        $this->assertEquals(['foo' => User::class], $this->metadata()->discriminatorMap);
    }

    /**
     * @test
     */
    public function can_set_default_discriminator_value()
    {
        $this->assertBuilder(
            $this->builder
                ->singleCollectionInheritance()
                ->discriminate('type')
                ->setDefault('foo')
        );

        $this->builder->build();

        $this->assertEquals('foo', $this->metadata()->defaultDiscriminatorValue);
    }

    /**
     * @test
     */
    public function can_set_change_tracking_policy()
    {
        $this->assertBuilder($this->builder->trackChangesImplicitly());
        $this->assertBuilder($this->builder->trackChangesExplicitly());

        $this->assertEquals(ClassMetadata::CHANGETRACKING_DEFERRED_EXPLICIT, $this->metadata()->changeTrackingPolicy);

        $this->assertBuilder($this->builder->trackChangesImplicitly());

        $this->assertEquals(ClassMetadata::CHANGETRACKING_DEFERRED_IMPLICIT, $this->metadata()->changeTrackingPolicy);

        $this->assertBuilder($this->builder->trackChangesWithNotification());

        $this->assertEquals(ClassMetadata::CHANGETRACKING_NOTIFY, $this->metadata()->changeTrackingPolicy);
    }

    /**
     * @test
     */
    public function can_set_shard_key()
    {
        $this->assertBuilder($this->builder->shardKey(['name' => 'asc']));

        $this->assertEquals(['name' => '1'], $this->metadata()->shardKey['keys']);
    }

    /**
     * @test
     */
    public function can_set_slave_okay()
    {
        $this->assertBuilder($this->builder->allowReadFromSlaves());

        $this->assertTrue($this->metadata()->slaveOkay);
    }

    /**
     * @test
     */
    public function can_version()
    {
        $this->assertBuilder($this->builder->version());

        $this->assertTrue($this->metadata()->isVersioned);
    }

    /**
     * @test
     */
    public function can_build_embed()
    {
        $this->assertBuilder($this->builder->embed());
    }

    /**
     * @test
     */
    public function can_build_reference()
    {
        $this->assertBuilder($this->builder->reference());
    }

    /**
     * @test
     */
    public function can_build_index()
    {
        $this->assertInstanceOf(Index::class, $this->builder->index());
    }

    /**
     * @test
     */
    public function can_add_built_indexes()
    {
        $this->builder->index();
        $this->builder->index();
        $this->builder->index();

        $this->assertBuilder(
            $this->builder
        );

        $this->builder->build();

        $this->assertCount(3, $this->metadata()->indexes);
    }

    /**
     * @test
     */
    public function can_add_document_listener()
    {
        $this->builder->addLifecycleCallback('postPersist', 'method');
        $this->assertCount(1, $this->metadata()->getLifecycleCallbacks('postPersist'));
        $this->assertEquals('method', $this->metadata()->getLifecycleCallbacks('postPersist')[0]);
    }

    /**
     * @test
     */
    public function can_set_custom_repository_class()
    {
        $this->builder->repository(CustomRepo::class);
        $this->assertEquals(CustomRepo::class, $this->metadata()->customRepositoryClassName);
    }
}

class ExampleDocumentListener
{

}

class CustomRepo extends DocumentRepository {

}