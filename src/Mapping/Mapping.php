<?php


namespace CImrie\Slick\Mapping;


use CImrie\Slick\Slick;

interface Mapping
{
    /**
     * @return string
     */
    public static function mapFor();

    /**
     * @param Slick $builder
     */
    public function map(Slick $builder);

    /**
     * @return boolean
     */
    public function isTransient();
}