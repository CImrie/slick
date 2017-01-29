<?php


namespace Tests\Laravel;


use Carbon\Carbon;
use CImrie\Slick\Mapping\SlickDriver;
use CImrie\Slick\SlickServiceProvider;
use CImrie\Slick\Types\CarbonDatetime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Types\Type;
use Tests\Model\Documents\Employee;
use Tests\Model\Mapping\EmployeeMapping;

class CarbonDatetimeTest extends \TestCase
{
    /**
     * @var DocumentManager
     */
    protected $dm;

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
        $this->app->make('config')->set('odm.managers.default.mappings', [EmployeeMapping::class]);
        $this->app->register(SlickServiceProvider::class);
        $this->dm = $this->app->make(DocumentManager::class);
    }

    /**
     * @test
     */
    public function can_save_and_retrieve_a_datetime_from_and_to_a_timezone()
    {
        $employee = new Employee();
        Type::addType('carbondate', CarbonDatetime::class); //todo

        $employee->setJoinedAt($joined = (clone Carbon::now())->subYear());
        $employee->setLastClockedInAt( $clocked = (clone Carbon::now())->subMinutes(5));

        $this->dm->persist($employee);
        $this->dm->flush();

        $repo = $this->dm->getRepository(Employee::class);
        $foundEmployee = $repo->find($employee->getId());

        $this->assertInstanceOf(Carbon::class, $foundEmployee->getJoinedAt());
        $this->assertInstanceOf(Carbon::class, $foundEmployee->getLastClockedInAt());
    }
}