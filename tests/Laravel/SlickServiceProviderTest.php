<?php


namespace Tests\Laravel;


use CImrie\Slick\Slick;
use CImrie\Slick\Mapping\DocumentMapping;
use CImrie\Slick\Mapping\SlickDriver;
use CImrie\Slick\SlickServiceProvider;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Id\AbstractIdGenerator;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\App;
use Tests\Model\Documents\Employee;
use Tests\Model\Documents\User;

class SlickServiceProviderTest extends \TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->app->make('config')->set('odm', require(__DIR__ . '/../../vendor/cimrie/odm/config/odm.php'));
        $this->app->make('config')->set('database.connections.mongodb', [
            'driver'   => 'mongodb',
            'host'     => 'localhost',
            'port'     => 27017,
            'database' => 'odm_test',
            'username' => null,
            'password' => null,
            'options'  => [
                'database' => 'admin',
            ],
        ]);
        $this->app->make('config')->set('odm.managers.default.meta', SlickDriver::class);
//        $this->app->make('config')->set('odm.metadata_drivers', [SlickDriver::class]);
        $this->app->make('config')->set('odm.managers.default.mappings', [CustomMapping::class, ResolveableMapping::class, GeneratedValueMapping::class]);
        $this->app->register(SlickServiceProvider::class);
    }

    /**
     * @test
     */
    public function can_use_slick_driver_to_load_mapping_file()
    {
        /** @var DocumentManager $dm */
        $dm = $this->app->make(DocumentManager::class);
        $metadata = $dm->getClassMetadata(User::class);

        $this->assertInstanceOf(ClassMetadata::class, $metadata);
        $this->assertEquals(['id'], $metadata->getIdentifier());
    }

    /**
     * @test
     */
    public function can_resolve_mapping_files_from_container()
    {
        $dm = $this->app->make(DocumentManager::class);
        $metadata = $dm->getClassMetadata(Employee::class);

        $this->assertInstanceOf(ClassMetadata::class, $metadata);
        $this->assertEquals(['id'], $metadata->getIdentifier());
    }

    /**
     * @test
     */
    public function generated_value_options_are_set_on_new_instance()
    {
        $dm = $this->app->make(DocumentManager::class);
        /** @var \Doctrine\ODM\MongoDB\Mapping\ClassMetadata $metadata */
        $metadata = $dm->getClassMetadata(GenValueDocument::class);

        $this->assertInstanceOf(TestGenerator::class, $metadata->idGenerator);
        $this->assertInstanceOf(Mailer::class, $metadata->idGenerator->getMailer());
    }
}

class CustomMapping extends DocumentMapping {

    public static function mapFor()
    {
        return User::class;
    }

    public function map(Slick $builder)
    {
        $builder->id();
    }
}

class ResolveableMapping extends DocumentMapping {

    public function __construct(Mailer $mailer)
    {

    }

    public static function mapFor()
    {
        return Employee::class;
    }

    public function map(Slick $builder)
    {
        $builder->id();
    }

}

class GenValueDocument {

    /**
     * @var string
     */
    protected $id;
}

class GeneratedValueMapping extends DocumentMapping {
    public static function mapFor()
    {
        return GenValueDocument::class;
    }

    public function map(Slick $builder)
    {
        $builder->string('id')->identifier()->generatedValue()->custom(new TestGenerator());
    }

}

class TestGenerator extends AbstractIdGenerator {

    protected $mailer;

    public function __construct()
    {
        $this->mailer = App::make(Mailer::class);
    }

    public function getMailer()
    {
        return $this->mailer;
    }

    public function setMailer(Mailer $mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    public function generate(DocumentManager $dm, $document)
    {
        return 'test';
    }

}