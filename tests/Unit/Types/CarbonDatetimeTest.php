<?php


namespace Tests\Unit\Types;


use Carbon\Carbon;
use CImrie\Slick\Types\CarbonDatetime;
use Doctrine\ODM\MongoDB\Types\Type;

class CarbonDatetimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function can_convert_to_php_value()
    {
        Type::addType('carbon', CarbonDatetime::class);
        $type = Type::getType('carbon');

        $now = microtime(true);
        $timestamp = (new \MongoDate($now));

        $this->assertInstanceOf(Carbon::class, $type->convertToPHPValue($timestamp));
        $this->assertEquals(explode('.', $now)[0], $type->convertToPHPValue($timestamp)->timestamp);
    }
}