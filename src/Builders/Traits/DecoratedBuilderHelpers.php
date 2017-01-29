<?php


namespace CImrie\Slick\Builders\Traits;


use CImrie\Slick\Builders\Builder;

trait DecoratedBuilderHelpers
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Builder $builder
     * @return Builder
     */
    protected function builder(Builder $builder)
    {
        $this->builder = $builder;

        return $builder;
    }

    public function build()
    {
        return $this->builder->build();
    }
}