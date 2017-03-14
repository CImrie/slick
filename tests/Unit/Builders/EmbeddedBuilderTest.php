<?php


namespace Tests\Unit\Builders;


use CImrie\ODM\Mapping\ClassMetadataBuilder;
use CImrie\Slick\Builders\EmbedBuilder;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Tests\Model\Documents\User;
use Tests\TestCase;

class EmbeddedBuilderTest extends TestCase
{
    /**
     * @var EmbedBuilder
     */
    protected $builder;

    protected function setUp()
    {
        parent::setUp();
        $this->metadataBuilder = new ClassMetadataBuilder(
            new ClassMetadata(User::class)
        );
        $this->builder = new EmbedBuilder($this->metadataBuilder);
    }

    /**
     * @test
     */
    public function can_embed_one_document()
    {
        $this->builder
            ->one(User::class)
            ->field('user')
            ->discriminate('type')
                ->with(['user' => User::class])
                ->setDefault('test')
            ;

        $this->builder->build();

        $this->assertEquals(User::class, $this->metadata()->fieldMappings['user']['targetDocument']);
        $this->assertEquals('type', $this->metadata()->fieldMappings['user']['discriminatorField']);
        $this->assertEquals(['user' => User::class], $this->metadata()->fieldMappings['user']['discriminatorMap']);
        $this->assertEquals('test', $this->metadata()->fieldMappings['user']['defaultDiscriminatorValue']);
    }

    /**
     * @test
     */
    public function can_embed_many_documents()
    {
        $this->builder->many(User::class)
            ->field('users');

        $this->builder->build();

        $this->assertEquals(User::class, $this->metadata()->fieldMappings['users']['targetDocument']);
    }

    /**
     * @test
     */
    public function can_store_with_add_to_set_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->useAddToSetStorageStrategy();

        $this->builder->build();

        $this->assertEquals('addToSet', $this->metadata()->fieldMappings['users']['strategy']);
    }

    /**
     * @test
     */
    public function can_store_with_push_all_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->usePushAllStorageStrategy();

        $this->builder->build();

        $this->assertEquals('pushAll', $this->metadata()->fieldMappings['users']['strategy']);
    }

    /**
     * @test
     */
    public function can_store_with_set_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->useSetStorageStrategy();

        $this->builder->build();

        $this->assertEquals('set', $this->metadata()->fieldMappings['users']['strategy']);
    }

    /**
     * @test
     */
    public function can_store_with_set_array_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->useSetArrayStorageStrategy();

        $this->builder->build();

        $this->assertEquals('setArray', $this->metadata()->fieldMappings['users']['strategy']);
    }

    /**
     * @test
     */
    public function can_store_with_atomic_set_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->useAtomicSetStorageStrategy();

        $this->builder->build();

        $this->assertEquals('atomicSet', $this->metadata()->fieldMappings['users']['strategy']);
    }

    /**
     * @test
     */
    public function can_store_with_atomic_set_array_strategy()
    {
        $this->builder->many(User::class)
            ->field('users')
            ->useAtomicSetArrayStorageStrategy();

        $this->builder->build();

        $this->assertEquals('atomicSetArray', $this->metadata()->fieldMappings['users']['strategy']);
    }
}