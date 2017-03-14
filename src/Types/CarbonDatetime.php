<?php


namespace CImrie\Slick\Types;


use Carbon\Carbon;
use Doctrine\ODM\MongoDB\Types\Type;

class CarbonDatetime extends Type
{
    public function convertToPHPValue($value)
    {
        $timestamp = $value->sec;
        return Carbon::createFromTimestampUTC($timestamp);
    }

    public function closureToPHP()
    {
        return '$return = \Carbon\Carbon::createFromTimestampUTC($value->usec);';
    }

    public function convertToDatabaseValue($value)
    {
        return new \MongoDate($value->timestamp);
    }
}