<?php


namespace Tests\Model\Mapping;


use CImrie\Slick\Slick;
use CImrie\Slick\Mapping\DocumentMapping;
use Tests\Model\Documents\Employee;

class EmployeeMapping extends DocumentMapping {

    public static function mapFor()
    {
        return Employee::class;
    }

    public function map(Slick $builder)
    {
        $builder->id();
        $builder->carbondate('joinedAt');
        $builder->carbondate('lastClockedInAt');
    }

}